# Modul 2 - HTML (Tabel Data Mahasiswa Terpusat Tanpa CSS)

Repository ini berisi tugas praktikum Modul 2 mata kuliah Aplikasi Berbasis Platform, yaitu membuat tabel dasar yang diposisikan di tengah layar secara vertikal dan horizontal murni menggunakan tag dan atribut HTML bawaan tanpa menggunakan CSS.

## Identitas Pembuat
* **Nama:** Deshan Rafif Alfarisi
* **NIM:** 2311102326
* **Kelas:** S1 IF-11-01

---

## Source Code (`index.html`)

Berikut adalah kode lengkap dari file `index.html`:

```html
<!DOCTYPE html>
<html height="100%">
<head>
    <title>Tabel Mahasiswa</title>
</head>
<body height="100%">
    <table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center" valign="middle">
                <h3>Data Mahasiswa</h3>
                <table border="1" cellpadding="10" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>NIM</th>
                            <th>Kelas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1.</td>
                            <td>Deshan</td>
                            <td>2311102326</td>
                            <td>IF-11-01</td>
                        </tr>
                        <tr>
                            <td>2.</td>
                            <td>Rafif</td>
                            <td>2311102326</td>
                            <td>IF-11-01</td>
                        </tr>
                        <tr>
                            <td>3.</td>
                            <td>Alfarisi</td>
                            <td>2311102326</td>
                            <td>IF-11-01</td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
```

---

## Penjelasan Singkat
* **Pemosisian Tengah (Vertical & Horizontal Center):** Menggunakan tabel pembungkus (`wrapper table`) luar dengan `width="100%"` dan `height="100%"`. Konten diposisikan ke tengah menggunakan atribut bawaan `align="center"` (horizontal) dan `valign="middle"` (vertikal) pada tag `<td>`.
* **Ketebalan Garis & Jarak Sel:** Diatur murni menggunakan atribut `border="1"`, `cellpadding="10"`, dan `cellspacing="0"` pada tag `<table>`.
* **Judul Tabel:** Ditambahkan heading `<h3>Data Mahasiswa</h3>` tepat di atas tabel.
