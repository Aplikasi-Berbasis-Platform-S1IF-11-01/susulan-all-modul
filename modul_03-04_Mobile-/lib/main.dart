import 'package:flutter/material.dart';

void main() {
  runApp(const MyApp());
}

class MyApp extends StatelessWidget {
  const MyApp({super.key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'Tugas Modul 4',
      theme: ThemeData(
        primarySwatch: Colors.orange,
        scaffoldBackgroundColor: Colors.grey[100],
      ),
      home: const ModulEmpatPage(),
      debugShowCheckedModeBanner: false,
    );
  }
}

class ModulEmpatPage extends StatelessWidget {
  const ModulEmpatPage({super.key});

  // Data array untuk ListView.builder
  final List<Map<String, String>> dataWarung = const [
    {'nama': 'Angkringan & Bakso Yone', 'menu': 'Bakso Spesial & Sate-satean'},
    {'nama': 'Askara Cafe', 'menu': 'Kopi Susu & Snack'},
    {'nama': 'Nasi Goreng Mas Acil', 'menu': 'Nasi Goreng Gila & Kwetiau'},
    {'nama': 'Restu Bundo', 'menu': 'Nasi Padang Rendang'},
  ];

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Eksplorasi Kuliner', style: TextStyle(fontWeight: FontWeight.bold)),
        backgroundColor: Colors.orange[700],
        elevation: 0,
      ),
      body: SingleChildScrollView(
        padding: const EdgeInsets.all(16.0),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            // --- IDENTITAS PEMILIK TUGAS ---
            Card(
              color: Colors.orange[50],
              elevation: 0,
              shape: RoundedRectangleBorder(
                side: BorderSide(color: Colors.orange[300]!, width: 1.5),
                borderRadius: BorderRadius.circular(12),
              ),
              child: const ListTile(
                leading: CircleAvatar(
                  backgroundColor: Colors.deepOrange,
                  child: Icon(Icons.person, color: Colors.white),
                ),
                title: Text(
                  'Imelda Fajar Awalina Crisyanti',
                  style: TextStyle(fontWeight: FontWeight.bold, fontSize: 16),
                ),
                subtitle: Text('Praktikum Modul 4 - Flutter Layout'),
              ),
            ),
            const SizedBox(height: 24),

            // --- 1. Container (Banner Utama) ---
            const Text('1. Container (Banner)', style: TextStyle(fontSize: 16, fontWeight: FontWeight.bold)),
            const SizedBox(height: 8),
            Container(
              padding: const EdgeInsets.all(20),
              width: double.infinity,
              decoration: BoxDecoration(
                gradient: LinearGradient(colors: [Colors.orange[400]!, Colors.deepOrange[600]!]),
                borderRadius: BorderRadius.circular(15),
                boxShadow: const [BoxShadow(color: Colors.black26, blurRadius: 5, offset: Offset(0, 3))],
              ),
              child: const Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Text('Selamat Datang!', style: TextStyle(color: Colors.white, fontSize: 22, fontWeight: FontWeight.bold)),
                  SizedBox(height: 5),
                  Text('Temukan makanan favoritmu di sini.', style: TextStyle(color: Colors.white70, fontSize: 14)),
                ],
              ),
            ),
            const SizedBox(height: 24),

            // --- 2. Stack (Kartu Promo) ---
            const Text('2. Stack (Promo Hari Ini)', style: TextStyle(fontSize: 16, fontWeight: FontWeight.bold)),
            const SizedBox(height: 8),
            Stack(
              children: [
                Container(
                  height: 120,
                  width: double.infinity,
                  decoration: BoxDecoration(
                    color: Colors.blue[100],
                    borderRadius: BorderRadius.circular(15),
                  ),
                ),
                Positioned(
                  right: -20,
                  top: -20,
                  child: Icon(Icons.fastfood, size: 100, color: Colors.blue[200]),
                ),
                const Positioned(
                  left: 20,
                  top: 30,
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      Text('Diskon 50%', style: TextStyle(fontSize: 24, fontWeight: FontWeight.bold, color: Colors.blueAccent)),
                      Text('Khusus pemesanan hari ini!', style: TextStyle(fontSize: 14, color: Colors.black54)),
                    ],
                  ),
                ),
              ],
            ),
            const SizedBox(height: 24),

            // --- 3. GridView (Kategori Menu) ---
            const Text('3. GridView (Kategori Makanan)', style: TextStyle(fontSize: 16, fontWeight: FontWeight.bold)),
            const SizedBox(height: 8),
            GridView.count(
              crossAxisCount: 3,
              shrinkWrap: true,
              physics: const NeverScrollableScrollPhysics(),
              crossAxisSpacing: 12,
              mainAxisSpacing: 12,
              children: [
                _buildGridItem(Icons.ramen_dining, 'Mie Ayam', Colors.green),
                _buildGridItem(Icons.rice_bowl, 'Soto Kwali', Colors.brown),
                _buildGridItem(Icons.local_fire_department, 'Ayam Bakar', Colors.red),
                _buildGridItem(Icons.set_meal, 'Dimsum', Colors.teal),
                _buildGridItem(Icons.lunch_dining, 'Burger', Colors.amber),
                _buildGridItem(Icons.local_cafe, 'Minuman', Colors.blueGrey),
              ],
            ),
            const SizedBox(height: 24),

            // --- 4. ListView (Rekomendasi Teratas A, B, C) ---
            const Text('4. ListView (Paket Hemat)', style: TextStyle(fontSize: 16, fontWeight: FontWeight.bold)),
            ListView(
              shrinkWrap: true,
              physics: const NeverScrollableScrollPhysics(),
              children: const [
                Card(child: ListTile(leading: CircleAvatar(backgroundColor: Colors.orange, child: Text('A')), title: Text('Paket Kenyang A'), subtitle: Text('Ayam Bakar + Nasi + Es Teh'))),
                Card(child: ListTile(leading: CircleAvatar(backgroundColor: Colors.orange, child: Text('B')), title: Text('Paket Kenyang B'), subtitle: Text('Mie Ayam + Dimsum + Jeruk Hangat'))),
                Card(child: ListTile(leading: CircleAvatar(backgroundColor: Colors.orange, child: Text('C')), title: Text('Paket Kenyang C'), subtitle: Text('Nasi Goreng + Telur + Krupuk'))),
              ],
            ),
            const SizedBox(height: 24),

            // --- 5. ListView.builder (Daftar Restoran dari Array) ---
            const Text('5. ListView.builder (Restoran Pilihan)', style: TextStyle(fontSize: 16, fontWeight: FontWeight.bold)),
            const SizedBox(height: 8),
            ListView.builder(
              shrinkWrap: true,
              physics: const NeverScrollableScrollPhysics(),
              itemCount: dataWarung.length,
              itemBuilder: (context, index) {
                return Container(
                  margin: const EdgeInsets.only(bottom: 8),
                  decoration: BoxDecoration(
                    color: Colors.white,
                    borderRadius: BorderRadius.circular(10),
                    border: Border.all(color: Colors.grey[300]!),
                  ),
                  child: ListTile(
                    leading: const Icon(Icons.storefront, color: Colors.deepOrange),
                    title: Text(dataWarung[index]['nama']!, style: const TextStyle(fontWeight: FontWeight.bold)),
                    subtitle: Text(dataWarung[index]['menu']!),
                    trailing: const Icon(Icons.arrow_forward_ios, size: 16),
                  ),
                );
              },
            ),
            const SizedBox(height: 24),

            // --- 6. ListView.separated (Riwayat Pesanan) ---
            const Text('6. ListView.separated (Riwayat Transaksi)', style: TextStyle(fontSize: 16, fontWeight: FontWeight.bold)),
            const SizedBox(height: 8),
            Container(
              color: Colors.white,
              child: ListView.separated(
                shrinkWrap: true,
                physics: const NeverScrollableScrollPhysics(),
                itemCount: 3,
                separatorBuilder: (context, index) => const Divider(height: 1, color: Colors.grey),
                itemBuilder: (context, index) {
                  List<String> riwayat = ['Pembayaran QRIS - Rp 45.000', 'Transfer Bank - Rp 20.000', 'Top Up Saldo - Rp 100.000'];
                  List<String> waktu = ['Hari ini, 12:30', 'Kemarin, 19:15', '2 Hari lalu, 09:00'];
                  return ListTile(
                    leading: const Icon(Icons.history, color: Colors.blue),
                    title: Text(riwayat[index]),
                    subtitle: Text(waktu[index]),
                  );
                },
              ),
            ),
          ],
        ),
      ),
    );
  }

  // Widget helper untuk GridView agar kode lebih rapi
  Widget _buildGridItem(IconData icon, String title, MaterialColor color) {
    return Container(
      decoration: BoxDecoration(
        color: color[50],
        borderRadius: BorderRadius.circular(15),
        border: Border.all(color: color[200]!),
      ),
      child: Column(
        mainAxisAlignment: MainAxisAlignment.center,
        children: [
          Icon(icon, size: 36, color: color[700]),
          const SizedBox(height: 8),
          Text(title, style: TextStyle(color: color[900], fontWeight: FontWeight.bold, fontSize: 12)),
        ],
      ),
    );
  }
}