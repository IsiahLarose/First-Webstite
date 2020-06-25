CREATE Table IF NOT EXISTS Survey(
id int UNIQUE auto_increment,
user_id int not null UNIQUE,
created datetime default current_timestamp,
cached_token_count int,
)