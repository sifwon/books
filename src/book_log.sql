drop table if exists review;
create table review(
    id integer auto_increment not null primary key,
    title varchar(255),
    author varchar(255),
    status varchar(255),
    score varchar(255),
    thoughts varchar(255),
    created_at timestamp default current_timestamp
)default character set=utf8mb4;