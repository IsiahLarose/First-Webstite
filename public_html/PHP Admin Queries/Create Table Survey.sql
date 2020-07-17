CREATE TABLE Survey(
id int auto_increment,
user_id int not null,
created datetime default current_timestamp,
cached_taken_count int,
FOREIGN KEY (user_id) REFERENCES Users(id) /*ON UPDATE CASCADE*/
)