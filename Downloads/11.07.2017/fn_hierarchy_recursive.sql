DELIMITER $$

-- DROP FUNCTION fn_hierarchy_recursive
 
CREATE FUNCTION fn_hierarchy_recursive(p_approving_head varchar(120), 
p_employee varchar(120)) 
RETURNS VARCHAR(120)
    DETERMINISTIC
BEGIN
    
	DECLARE v_employee varchar(120);
	DECLARE v_true char(1);
	DECLARE v_count int;
	
	set v_true = 'F';
	set v_employee = p_employee;
	
	while v_true = 'F' DO
		/* select approving_head_name,  count(*)
		into v_employee, v_count
		from cric_employee_hierarchy
		where employee_name = v_employee; */
		
		select approving_head_id,  count(*)
		into v_employee, v_count
		from cric_employee_hierarchy
		where employee_id = v_employee;
		
		if v_count > 0 then
			if v_employee = p_approving_head then
				set v_true = 'T';
			end if;
		else
			set v_employee = '';
			set v_true = 'T';
		end if;
	
	end while;
 
    
 
 RETURN (v_employee);
END
