SELECT * FROM Questions where question like CONCAT('%', :question, '%')
