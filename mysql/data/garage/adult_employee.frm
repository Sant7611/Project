TYPE=VIEW
query=select `garage`.`employee`.`e_id` AS `e_id`,`garage`.`employee`.`e_name` AS `e_name`,`garage`.`employee`.`address` AS `address`,`garage`.`employee`.`gender` AS `gender`,`garage`.`employee`.`age` AS `age` from `garage`.`employee` where `garage`.`employee`.`age` >= 18
md5=9c1fb3b676f6a9c566f92e7fe90d7808
updatable=1
algorithm=0
definer_user=root
definer_host=localhost
suid=2
with_check_option=0
timestamp=2024-03-25 16:36:08
create-version=2
source=select * from employee where age >=18
client_cs_name=utf8mb4
connection_cl_name=utf8mb4_general_ci
view_body_utf8=select `garage`.`employee`.`e_id` AS `e_id`,`garage`.`employee`.`e_name` AS `e_name`,`garage`.`employee`.`address` AS `address`,`garage`.`employee`.`gender` AS `gender`,`garage`.`employee`.`age` AS `age` from `garage`.`employee` where `garage`.`employee`.`age` >= 18
mariadb-version=100425
