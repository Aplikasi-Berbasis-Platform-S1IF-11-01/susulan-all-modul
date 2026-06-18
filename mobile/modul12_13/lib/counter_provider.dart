import 'package:flutter/material.dart';
import 'notification_service.dart';

class CounterProvider extends ChangeNotifier {
  int _counter = 0;
  final List<String> _history = [];

  int get counter => _counter;
  List<String> get history => List.unmodifiable(_history);

  void increment() {
    _counter++;
    _addHistory('Ditambah → $_counter');
    notifyListeners();

    _safeNotify(_counter, 'increment');
  }

  void decrement() {
    if (_counter > 0) {
      _counter--;
      _addHistory('Dikurangi → $_counter');
      notifyListeners();

      _safeNotify(_counter, 'decrement');
    }
  }

  void reset() {
    _counter = 0;
    _addHistory('Direset → 0');
    notifyListeners();

    _safeNotify(_counter, 'reset');
  }

  void _addHistory(String entry) {
    final now = TimeOfDay.now();
    final time =
        '${now.hour.toString().padLeft(2, '0')}:${now.minute.toString().padLeft(2, '0')}';

    _history.insert(0, '[$time] $entry');

    // max 5 history (clean way)
    if (_history.length > 5) {
      _history.removeLast();
    }
  }

  // 🔥 SAFE NOTIFICATION (ANTI ERROR WEB)
  void _safeNotify(int value, String type) {
    try {
      NotificationService.showNotification(value, type);
    } catch (e) {
      debugPrint('Notification skipped: $e');
    }
  }
}
