create table utente (
    nome varchar(40),
    email varchar(40),
    pswd varchar(32) not null,
    primary key (email)
);