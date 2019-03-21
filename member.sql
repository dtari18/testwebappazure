create table [dbo].[member](
idm int not null identity(1,1) primary key(idm),
fullname varchar(255),
age int,
city varchar(255),
tgl date
);
