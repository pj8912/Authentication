create table users
(
    userid int    auto_increment primary key not null,
    fullname VARCHAR
    (300) not null,
    username VARCHAR
    (300) not null,
    email VARCHAR
    (300) not null,
    pwd VARCHAR
    (300) not null

);