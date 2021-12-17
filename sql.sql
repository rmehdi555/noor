-- 1400-07-16
ALTER TABLE `students_fields` ADD `user_id` INT(20) NOT NULL DEFAULT '0' AFTER `student_id`;


--  حذف ثبت نام کلاس هایی که پرداخت نشده اند
DELETE FROM `students_fields` WHERE `deleted_at` IS NOT NULL



INSERT INTO `site_details` (`id`, `title`, `key`, `user_id`, `value`, `images`, `type`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES (NULL, 'متن صفحه ثبت نام کلاس جدید در چتنل قرآن آموز', 'page_students_class_register_body', '40', '<p>قرآنی عزیز لطفا با مطالعه بخش کلاس ها و طرح های آموزشی، پس از انتخاب نوع کلاس (آنلاین یا حضوری) رشته مورد نظر خود را انتخاب کنید:</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>چند نکته :</p>\r\n\r\n<p>1- رشته هایی که با رنگ قرمز نمایش داده شده اند فعلا قابلیت ثبت نام ندارند.</p>\r\n\r\n<p>2- از هر دسته اصلی رشته تنها&nbsp;یک زیر دسته میتوان انتخاب نمود.</p>\r\n', '[]', 'text', '1', '2020-12-06 13:01:41', '2020-12-16 05:12:58', NULL);


-- id payment
ALTER TABLE `students_fields` ADD `payment_id` INT(20) NOT NULL DEFAULT '0' AFTER `user_id`;


--create table
malis
-- با دیتا
class_rooms
class_rooms_students
practices
practices_accesses
practices_details
-- شماره شروع از 1000
tickets
tickets_details
messages
messages_details
method_of_letters
meetings
meeting_accesses
deposits
deposits_types
-- با دیتا
mark_types
-- با دیتا
mark_type_grades
exams
exams_questions
exams_questions_options
exams_response_students
-- با دیتا
class_rooms_teachers
exams_response_teachers


--1400-09-18
ALTER TABLE `fields` ADD `type` VARCHAR(191) NOT NULL DEFAULT 'student' AFTER `price`;

ALTER TABLE `teachers` ADD `type` VARCHAR(191) NOT NULL DEFAULT 'student' AFTER `sex`;


