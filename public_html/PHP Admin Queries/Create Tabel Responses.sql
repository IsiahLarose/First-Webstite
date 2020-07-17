Create TABLE Responses (
id int auto_increment,
survey_id int,
question_id int,
answer_id int
user_id int,
created datetime default current_timestamp,
PRIMARY KEY(id),
Foreign KEY (user_id) References Users(id), /* ON Update cascade*/
FOREIGN KEY (survey_id) REFERENCES Survey(id)/* ON Update cascade*/
)