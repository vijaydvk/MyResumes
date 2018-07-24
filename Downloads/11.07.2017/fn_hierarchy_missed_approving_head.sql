DELIMITER $$

-- DROP FUNCTION fn_hierarchy_missed_approving_head
 
CREATE FUNCTION fn_hierarchy_missed_approving_head(p_approving_head varchar(120), 
p_employee varchar(120)) 
RETURNS VARCHAR(120)
    DETERMINISTIC
BEGIN
    
	DECLARE v_missed_app_head varchar(120);
	DECLARE v_employee varchar(120);
	DECLARE v_count int;
	
	set v_employee = p_employee;
		
	/* select approving_head_name,  count(*)
	into v_missed_app_head, v_count
	from cric_employee_hierarchy
	where employee_name = v_employee; */
	
	select approving_head_id,  count(*)
	into v_missed_app_head, v_count
	from cric_employee_hierarchy
	where employee_id = v_employee;
		
	if v_count > 0 then
		set v_missed_app_head = v_missed_app_head;
	else
		set v_missed_app_head = 'Approving Head Not Available';
	end if;
    
 
 RETURN (v_missed_app_head);
END
