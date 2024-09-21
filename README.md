# Georgius Damarjati Susanto (215314203)
# Tugas REST API Client dan Server pada Project Todolist

## Dokumentasi RESTFULL API menggunakan OpenAPI (di Laravel terdapat pada folder app/docs/todo-api.json
![image](https://github.com/user-attachments/assets/e6681cd3-b5e1-4b05-b9e1-6b4e0897cead)

### Login
![image](https://github.com/user-attachments/assets/66d46a64-72ff-401c-ba77-041de28a6bbc)
### Daftar Todo
![image](https://github.com/user-attachments/assets/95bc4bba-ffbe-4dec-a7e1-092dacfab3c2)

### Buat Todo Baru
![image](https://github.com/user-attachments/assets/5e03c258-19f7-43b8-95d6-f78a5dfabe9a)

### Lihat Todo Berdasarkan ID
![image](https://github.com/user-attachments/assets/30eea9e5-b73c-454e-8847-861f13141947)

### Update Todo
![image](https://github.com/user-attachments/assets/c01eb3ea-1672-4eb1-8284-27e884af2478)

### Hapus Todo
![image](https://github.com/user-attachments/assets/8e5b4918-2103-4041-b1ef-bde3b28a70b0)
### Schemas
![image](https://github.com/user-attachments/assets/10b99af2-7343-4b3b-a5f2-34162594a9ba)


## Hasil RESTFULL API Client dan Server (menggunakan Postman)
### POST http://127.0.0.1:8000/api/login
Login terlebih dahulu untuk mendapatkan token. Login digunakan untuk melindungi API yang dibuat agar tidak sembarang orang bisa menggunakan API yang telah dibuat, nantinya token yang dihasilkan akan digunakan untuk mengakses setiap API yang dilindungi, dengan cara ke Headers, isikan key Authorization dan Value berupa Bearer + token yang telah dihasilkan
![image](https://github.com/user-attachments/assets/f3c56e42-ec53-41b7-9008-ef1469942242)


### GET http://127.0.0.1:8000/api/todos 
Digunakan untuk menampilkan seluruh data todos melalui method index pada controller
![image](https://github.com/user-attachments/assets/472899a6-80ac-4f76-9f77-dfc664d0275a)

### GET http://127.0.0.1:8000/api/todos/{id} (id = 7)
Digunakan untuk menampilkan data todo berdasarkan id melalui method show pada controller
![image](https://github.com/user-attachments/assets/3e71142f-c88d-4bef-a834-821800d55415)

### POST http://127.0.0.1:8000/api/todos
Digunakan untuk menambahkan data todo berdasarkan melalui method store pada controller
![image](https://github.com/user-attachments/assets/e92ab8d2-c57a-4b05-a684-5d99b7bf481d)

### PUT http://127.0.0.1:8000/api/todos/{id} (id = 7)
Digunakan untuk mengupdate data todo berdasarkan id melalui method update pada controller
![image](https://github.com/user-attachments/assets/387344ba-de20-4080-a956-9b4a245d2f89)

### DELETE http://127.0.0.1:8000/api/todos/{id} (id = 7)
Digunakan untuk menghapus data todo berdasarkan id melalui method destroy pada controller
Data todo dengan id = 7 berhasil di hapus
![image](https://github.com/user-attachments/assets/d6a3bf5d-ed38-4e37-bbd3-18466054475a)

Apabila melakukan delete dengan id = 7 lagi, maka data todo tidak ditemukan karena sudah terhapus.
![image](https://github.com/user-attachments/assets/6f5bf0c2-0248-49f4-9900-d2c51e04e687)

