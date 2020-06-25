SELECT * FROM Things where question like CONCAT('%', :question, '%')
