Create TABLE Questions(
id int auto_increment,
survey_id int not null,
question text not null,
PRIMARY KEY (id)
FOREIGN KEY(survey_id) REFERENCES Survey(id) /* ON Update cascade*/
)