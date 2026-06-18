const express = require('express');
const path = require('path');
const fs = require('fs');
const { v4: uuidv4 } = require('uuid');

const app = express();
const PORT = process.env.PORT || 3000;
const DATA_FILE = path.join(__dirname, 'data', 'inventory.json');

// Middleware
app.use(express.json());
app.use(express.urlencoded({ extended: true }));
app.use(express.static(path.join(__dirname, 'public')));

// Set EJS as Templating Engine
app.set('view engine', 'ejs');
app.set('views', path.join(__dirname, 'views'));

// Utility functions to read/write JSON data
const readData = () => {
  try {
    if (!fs.existsSync(DATA_FILE)) {
      // Ensure directory exists
      fs.mkdirSync(path.dirname(DATA_FILE), { recursive: true });
      fs.writeFileSync(DATA_FILE, JSON.stringify([], null, 2));
      return [];
    }
    const rawData = fs.readFileSync(DATA_FILE, 'utf8');
    return JSON.parse(rawData || '[]');
  } catch (error) {
    console.error('Error reading data file:', error);
    return [];
  }
};

const writeData = (data) => {
  try {
    fs.mkdirSync(path.dirname(DATA_FILE), { recursive: true });
    fs.writeFileSync(DATA_FILE, JSON.stringify(data, null, 2), 'utf8');
  } catch (error) {
    console.error('Error writing to data file:', error);
  }
};

// ==================== WEB ROUTES ====================

// 1. Dashboard Page
app.get('/', (req, res) => {
  const items = readData();
  
  // Calculate simple statistics for dashboard cards
  const stats = {
    totalItems: items.reduce((acc, item) => acc + (parseInt(item.quantity) || 0), 0),
    totalTypes: items.length,
    goodCondition: items.filter(i => i.condition === 'Baik').reduce((acc, item) => acc + (parseInt(item.quantity) || 0), 0),
    badCondition: items.filter(i => i.condition === 'Rusak').reduce((acc, item) => acc + (parseInt(item.quantity) || 0), 0),
    categories: {}
  };

  // Group by category
  items.forEach(i => {
    stats.categories[i.category] = (stats.categories[i.category] || 0) + 1;
  });

  res.render('index', { 
    title: 'Dashboard - GudangKu',
    stats: stats,
    recentItems: items.slice(-5).reverse() // Last 5 added
  });
});

// 2. Form Page (Add / Edit)
app.get('/form', (req, res) => {
  const editId = req.query.id;
  let editItem = null;

  if (editId) {
    const items = readData();
    editItem = items.find(i => i.id === editId) || null;
  }

  res.render('form', { 
    title: editItem ? 'Edit Barang - GudangKu' : 'Tambah Barang - GudangKu',
    editItem: editItem
  });
});

// 3. Table/Data View Page
app.get('/table', (req, res) => {
  res.render('table', { 
    title: 'Daftar Barang - GudangKu' 
  });
});

// ==================== API ROUTES (CRUD) ====================

// GET: Read all items (JSON formatted)
app.get('/api/inventory', (req, res) => {
  const items = readData();
  res.json({ data: items });
});

// GET: Read single item
app.get('/api/inventory/:id', (req, res) => {
  const items = readData();
  const item = items.find(i => i.id === req.params.id);
  if (!item) {
    return res.status(404).json({ success: false, message: 'Barang tidak ditemukan' });
  }
  res.json({ success: true, data: item });
});

// POST: Create new item
app.post('/api/inventory', (req, res) => {
  const { name, category, quantity, condition, location, notes } = req.body;
  
  if (!name || !category || !quantity || !condition) {
    return res.status(400).json({ success: false, message: 'Kolom wajib diisi!' });
  }

  const items = readData();
  const newItem = {
    id: uuidv4(),
    name,
    category,
    quantity: parseInt(quantity) || 0,
    condition,
    location: location || '-',
    notes: notes || '',
    createdAt: new Date().toISOString()
  };

  items.push(newItem);
  writeData(items);

  res.status(201).json({ success: true, message: 'Barang berhasil ditambahkan', data: newItem });
});

// PUT: Update an item
app.put('/api/inventory/:id', (req, res) => {
  const { name, category, quantity, condition, location, notes } = req.body;
  const items = readData();
  const index = items.findIndex(i => i.id === req.params.id);

  if (index === -1) {
    return res.status(404).json({ success: false, message: 'Barang tidak ditemukan' });
  }

  if (!name || !category || !quantity || !condition) {
    return res.status(400).json({ success: false, message: 'Kolom wajib diisi!' });
  }

  items[index] = {
    ...items[index],
    name,
    category,
    quantity: parseInt(quantity) || 0,
    condition,
    location: location || '-',
    notes: notes || ''
  };

  writeData(items);
  res.json({ success: true, message: 'Barang berhasil diperbarui', data: items[index] });
});

// DELETE: Delete an item
app.delete('/api/inventory/:id', (req, res) => {
  let items = readData();
  const index = items.findIndex(i => i.id === req.params.id);

  if (index === -1) {
    return res.status(404).json({ success: false, message: 'Barang tidak ditemukan' });
  }

  items.splice(index, 1);
  writeData(items);
  res.json({ success: true, message: 'Barang berhasil dihapus' });
});

// Start Server
app.listen(PORT, () => {
  console.log(`Server is running at http://localhost:${PORT}`);
});
