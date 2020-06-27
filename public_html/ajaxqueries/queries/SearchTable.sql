SELECT * FROM Question where name like CONCAT('%', :question, '%')
