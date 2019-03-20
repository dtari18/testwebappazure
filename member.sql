create table [dbo].[member](
idm int not null identity(1,1) primary key(idm),
fullname varchar(20),
age int,
city varchar(30),
tgl date
);