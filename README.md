# MVC
MVC
Nguyễn Hiếu Thành

Yêu Cầu:

Bước 1: Cài đặt chương trình mẫu

Bước 2: áp dụng PSR-4 bằng composer cho bài tập.

Yêu cầu: sử dụng namespace cho các class, loại bỏ include và require thay bằng use.

Bước 3: Sửa lại Model, cài đặt ORM. Có 2 phiên bản:

# Phiên bản 1: tự xây dựng ORM riêng.

Hướng dẫn:

- Lớp Model (core):

cung cấp hàm lấy các thuộc tính và giá trị của model. 

Gợi ý: sử dụng hàm get_object_vars

- Các lớp model thừa kế từ lớp Model (core) chỉ chứa thuộc tính và các phương thức get, set tương ứng với các trường trong bảng.

- Tạo 1 lớp core Resource model để thực hiện các lệnh sql CRUD.

Chú ý tên bảng, id khóa chính sẽ được truyền vào từ lớp con.

- Với mỗi model tạo lớp Resource Model tương ứng. Thừa kế từ lớp core Resource Model.

- Mỗi model tạo 1 lớp Repository tương ứng.

Cần cung cấp các phương thức:

+add($model): thêm 1 object model

+edit($model): sửa 1 object model

+delete($model): xóa 1 model

+get($id): trả về 1 object model

+getAll: trả về mảng các object model

Mỗi phương thức của lớp Repository sẽ gọi đến các phương thức của lớp Resource Model.

- Controller thực hiện các thao tác CRUD với model thông qua Repository.
