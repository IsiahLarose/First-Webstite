SELECT * FROM Questions where name like CONCAT('%', :question, '%')
