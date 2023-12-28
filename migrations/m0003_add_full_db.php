<?php
class m0003_add_full_db
{
    public function up()
    {
        $db = \app\core\Application::$app->db;
        $SQL = "
            CREATE TABLE admins (
              id INT(10) NOT NULL AUTO_INCREMENT, -- Tự động tăng
              login_id VARCHAR(20) NOT NULL UNIQUE, -- Đảm bảo rằng ID đăng nhập là duy nhất
              password VARCHAR(64) NOT NULL, -- Mật khẩu không được để trống
              actived_flag INT(1) DEFAULT 1, -- Cờ kích hoạt mặc định là 1
              reset_password_token VARCHAR(100), -- Token để đặt lại mật khẩu
              updated DATETIME ON UPDATE CURRENT_TIMESTAMP, -- Thời gian cập nhật mặc định là thời gian hiện tại khi cập nhật
              created DATETIME DEFAULT CURRENT_TIMESTAMP, -- Thời gian tạo mặc định là thời gian hiện tại
              PRIMARY KEY (id) -- Khóa chính
            ) ENGINE=InnoDB; -- Sử dụng InnoDB vì nó hỗ trợ các giao dịch
            
            -- Tạo bảng môn học
            CREATE TABLE subjects (
              id INT(10) NOT NULL AUTO_INCREMENT, -- Tự động tăng
              name VARCHAR(250), -- Tên môn học
              avatar VARCHAR(250), -- Tên của tệp avatar (không lưu trữ đường dẫn của tệp trong DB)
              description TEXT, -- Mô tả môn học
              school_year CHAR(10), -- Mã của năm học
              updated DATETIME, -- Thời gian cập nhật
              created DATETIME DEFAULT CURRENT_TIMESTAMP, -- Thời gian tạo mặc định là thời gian hiện tại
              PRIMARY KEY (id) -- Khóa chính
            ) ENGINE=InnoDB;
            
            -- Tạo bảng giáo viên
            CREATE TABLE teachers (
              id INT(10) NOT NULL AUTO_INCREMENT, -- Tự động tăng
              name VARCHAR(250), -- Tên giáo viên
              avatar VARCHAR(250), -- Tên của tệp avatar (không lưu trữ đường dẫn của tệp trong DB)
              description TEXT, -- Mô tả giáo viên
              specialized CHAR(10), -- Mã của chuyên ngành
              degree CHAR(10), -- Mã của bằng cấp
              updated DATETIME, -- Thời gian cập nhật
              created DATETIME DEFAULT CURRENT_TIMESTAMP, -- Thời gian tạo mặc định là thời gian hiện tại
              PRIMARY KEY (id) -- Khóa chính
            ) ENGINE=InnoDB;
            
            -- Tạo bảng sinh viên
            CREATE TABLE students (
              id INT(10) NOT NULL AUTO_INCREMENT, -- Tự động tăng
              name VARCHAR(250), -- Tên sinh viên
              avatar VARCHAR(250), -- Tên của tệp avatar (không lưu trữ đường dẫn của tệp trong DB)
              description TEXT, -- Mô tả sinh viên
              updated DATETIME, -- Thời gian cập nhật
              created DATETIME DEFAULT CURRENT_TIMESTAMP, -- Thời gian tạo mặc định là thời gian hiện tại
              PRIMARY KEY (id) -- Khóa chính
            ) ENGINE=InnoDB;
            
            -- Tạo bảng điểm
            CREATE TABLE scores (
              id INT(10) NOT NULL AUTO_INCREMENT, -- Tự động tăng
              student_id INT(10), -- Khóa ngoại liên kết với bảng students
              teacher_id INT(10), -- Khóa ngoại liên kết với bảng teachers
              subject_id INT(10), -- Khóa ngoại liên kết với bảng subjects
              score INT(2) DEFAULT 0, -- Điểm số mặc định là 0
              description TEXT, -- Mô tả thêm về điểm số
              updated DATETIME, -- Thời gian cập nhật điểm
              created DATETIME DEFAULT CURRENT_TIMESTAMP, -- Thời gian tạo điểm, mặc định là thời gian hiện tại
              PRIMARY KEY (id) -- Khóa chính
            ) ENGINE=InnoDB;
            
            -- Thêm khóa ngoại cho bảng scores
            ALTER TABLE scores
            ADD CONSTRAINT FK_student -- Khóa ngoại liên kết với bảng students
            FOREIGN KEY (student_id) REFERENCES students(id),
            ADD CONSTRAINT FK_teacher -- Khóa ngoại liên kết với bảng teachers
            FOREIGN KEY (teacher_id) REFERENCES teachers(id),
            ADD CONSTRAINT FK_subject -- Khóa ngoại liên kết với bảng subjects
            FOREIGN KEY (subject_id) REFERENCES subjects(id);
           ";
        $db->pdo->exec($SQL);
    }

    public function down()
    {
        $db = \app\core\Application::$app->db;
        $SQL = "
        DROP TABLE IF EXISTS scores;
        DROP TABLE IF EXISTS students;
        DROP TABLE IF EXISTS teachers;
        DROP TABLE IF EXISTS subjects;
        DROP TABLE IF EXISTS admins;
        ";
        $db->pdo->exec($SQL);
    }
}