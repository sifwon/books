drop table if exists pokemon;
create table pokemon(
    id integer auto_increment not null primary key,
    name varchar(255),
    personality varchar(255),
    characteristic varchar(255),
    belongings varchar(255),
    effort_value varchar(255),
    move varchar(255),
    created_at timestamp default current_timestamp
)default character set=utf8mb4;