create table user (
uid int(11) not null auto_increment,
uname varchar(30) not null,
password varchar(30) not null,
email varchar(50) default null,
create_time timestamp default '0000-00-00 00:00:00',
primary key(uid)
)DEFAULT CHARSET=utf8;

create table tag (
tid int(11) not null auto_increment,
tname varchar(30) not null,
primary key(tid)
) default charset utf8;

create table article(
aid int(11) not null auto_increment,
content text default null,
title varchar(30) not null,
create_time timestamp default '0000-00-00 00:00:00',
primary key(aid)
)default charset utf8;

 create table user_article_relation (
 uid int(11) not null,
 aid int(11) not null,
 reprinted bool not null default false,
 reprint_time timestamp default '0000-00-00 00:00:00',
 primary key(uid, aid),
 foreign key(uid) references user (uid),
 foreign key(aid) references article (aid)
 )DEFAULT CHARSET=utf8;

create table article_tag_relation (
aid int(11) not null,
tid int(11) not null,
primary key(tid, aid),
foreign key(tid) references tag(tid),
foreign key(aid) references article(aid)
)default charset utf8;

 insert into article values(1,'博客1的内容','博客1标题',now());
 insert into article values(2,'博客2的内容','博客2标题',now()); 
 insert into article values(3,'博客3的内容','博客3标题',now());
 insert into article values(4,'博客4的内容','博客4标题',now());
 insert into article values(5,'博客5的内容','博客5标题',now());
 insert into article values(6,'博客6的内容','博客6标题',now());
 insert into article values(7,'博客7的内容','博客7标题',now());
 insert into article values(8,'博客8的内容','博客8标题',now());
 insert into article values(9,'博客9的内容','博客9标题',now());
 insert into article values(10,'博客10的内容','博客10标题',now());
 insert into article values(11,'博客11的内容','博客11标题',now());
 insert into article values(12,'博客12的内容','博客12标题',now());
 insert into article values(13,'博客13的内容','博客13标题',now());
 insert into article values(14,'博客14的内容','博客14标题',now());
 
 
 
 insert into tag values(1,'linux');
 insert into tag values(2,'c++');
 insert into tag values(3,'C#');
 insert into tag values(4,'java');
 insert into tag values(5,'PHP');
 
 
 insert into article_tag_relation values (1,1); 
 insert into article_tag_relation values (2,1);
 insert into article_tag_relation values (3,1);
 insert into article_tag_relation values (4,1); 
 insert into article_tag_relation values (5,1);
 insert into article_tag_relation values (6,1);
 insert into article_tag_relation values (7,2);
 insert into article_tag_relation values (8,2); 
 insert into article_tag_relation values (9,2);
 insert into article_tag_relation values (10,2);
 insert into article_tag_relation values (11,2); 

 
 