**Sintaks Eloquent ORM Laravel yang lengkap dan tersusun per kategori**, cocok buat jadi **cheat sheet** saat kamu ngoding.

---

## 🧠 **1. Ambil Data (Read)**

### 🔹 Semua data

```php
$data = Model::all();
```

### 🔹 Data dengan urutan

```php
$data = Model::orderBy('created_at', 'desc')->get();
```

### 🔹 Ambil satu data (berdasarkan ID)

```php
$data = Model::find($id); // return null kalau tidak ada
$data = Model::findOrFail($id); // throw 404 kalau tidak ada
```

### 🔹 Query dengan kondisi

```php
$data = Model::where('status', 'approved')->get();
$data = Model::where('price', '>=', 10000)->first();
```

### 🔹 Pencarian lebih kompleks

```php
$data = Model::where('status', 'pending')
            ->where('category_id', 3)
            ->orderBy('created_at', 'desc')
            ->get();
```

---

## 📝 **2. Simpan Data Baru (Create)**

### 🔹 Cara cepat (mass assignment)

```php
Model::create([
    'name' => 'Produk A',
    'price' => 10000,
]);
```

> **Model harus punya** `protected $fillable` **atau** `protected $guarded`.

### 🔹 Cara manual

```php
$model = new Model;
$model->name = 'Produk A';
$model->price = 10000;
$model->save();
```

---

## ✏️ **3. Update Data**

### 🔹 Ambil dulu, lalu update

```php
$data = Model::find($id);
$data->name = 'Produk Baru';
$data->save();
```

### 🔹 Dengan `update()` langsung

```php
Model::where('id', $id)->update([
    'name' => 'Produk Baru',
    'price' => 15000,
]);
```

---

## ❌ **4. Hapus Data (Delete)**

### 🔹 Hapus berdasarkan ID

```php
Model::destroy($id);
```

### 🔹 Atau hapus instance

```php
$data = Model::find($id);
$data->delete();
```

### 🔹 Hapus dengan kondisi

```php
Model::where('status', 'expired')->delete();
```

---

## 🔁 **5. Relasi (Eloquent Relationship)**

### 🔹 One to Many

```php
// Di model User.php
public function posts() {
    return $this->hasMany(Post::class);
}

// Di controller
$posts = User::find(1)->posts;
```

### 🔹 Many to One

```php
// Di model Post.php
public function user() {
    return $this->belongsTo(User::class);
}
```

### 🔹 Many to Many

```php
public function roles() {
    return $this->belongsToMany(Role::class);
}
```

---

## 🧰 **6. Fitur Tambahan Eloquent**

### 🔹 Pagination

```php
$data = Model::paginate(10); // 10 data per halaman
```

### 🔹 Pluck field tertentu

```php
$names = Model::pluck('name');
```

### 🔹 Count

```php
$count = Model::where('status', 'pending')->count();
```

### 🔹 Cek apakah data ada

```php
Model::where('email', 'test@mail.com')->exists();
```

---

## ⚙️ **7. Soft Delete (opsional)**

### 🔹 Tambahkan di model

```php
use Illuminate\Database\Eloquent\SoftDeletes;

class Model extends Model {
    use SoftDeletes;
}
```

### 🔹 Tambahkan kolom di migration

```php
$table->softDeletes();
```

### 🔹 Menghapus secara soft

```php
Model::find($id)->delete();
```

### 🔹 Mengambil data yang dihapus

```php
Model::onlyTrashed()->get();
```
