DELIMITER $$

-- DROP FUNCTION fn_hierarchy_get_store_personnel
 
CREATE FUNCTION fn_hierarchy_get_store_personnel(p_store_id varchar(120)) 
RETURNS VARCHAR(1200)
    DETERMINISTIC
BEGIN
    DECLARE v_store_personnel varchar(1200);
	DECLARE v_store_id varchar(120);
	DECLARE v_phone_no varchar(120);
	DECLARE v_employee varchar(120);
	DECLARE v_employee_name varchar(120);
	DECLARE v_employee_id varchar(120);
	DECLARE v_approving_head_name varchar(120);
	DECLARE v_approving_head_designation varchar(120);
	DECLARE v_designation_name varchar(120);
	DECLARE v_true char(1);
	DECLARE v_count int;
	DECLARE v_ctr int;
	
	set v_true = 'F';
	set v_store_personnel = '';			
	set v_store_id = p_store_id;
	set v_ctr = 0;
	
	-- set v_employee_name = 
	select a.employee_id, a.employee_name from
	(select ifnull(employee_id,'notfound') as employee_id,
		employee_name
	from cric_employee_hierarchy
	where location_code = v_store_id
	and designation_code = 'RSM'
	union
	select 'notfound' as employee_id, '' as employee_name
	limit 1 ) a into v_employee, v_employee_name;
	
	/* insert into k18_error_log (company_id, user_id, error_log, createdon)
		values ('suncom1', v_employee_name, 'fn_hierarchy_get_dm_rd_vp', current_date());
	*/
	
	if v_employee <> 'notfound' then
		/* set v_phone_no = (select phone_no from cric_user_profile
		where login_user_id = v_employee); */
		set v_phone_no = (select ifnull(phone_no,'Phone no not found') as phone_no from cric_user_profile
				where login_user_id = v_employee
				union
				select 'Phone no not found' as phone_no
				limit 1);
		select concat('Store Manager',
		': ',v_employee_name,'</br>', 'SM Phone: ', v_phone_no,'</br>') into v_store_personnel;	
	end if;					
	while v_true = 'F' DO
		set v_ctr = v_ctr + 1;	
		if v_employee = 'notfound' then
			set v_true = 'T';
		end if;
			select approving_head_id, approving_head_name, 
			approving_head_designation
			into v_employee, v_approving_head_name, 
			v_approving_head_designation
			from cric_employee_hierarchy
			where employee_id = v_employee
			and approving_head_id <> ''
			and approving_head_designation <> ''
			and designation_code <> approving_head_designation
			and employee_id <> approving_head_id
			and approving_head_designation not in ('FIN1','FIN2','FIN3','HomeOffice')
			limit 1;
			
			set v_phone_no = (select ifnull(phone_no,'Phone no not found') as phone_no from cric_user_profile
				where login_user_id = v_employee
				union
				select 'Phone no not found' as phone_no
				limit 1);
			
			set v_designation_name = v_approving_head_designation;
			if v_approving_head_designation = 'DM' then
				set v_designation_name = 'District Manager';
			end if;
			if v_approving_head_designation = 'RD' then
				set v_designation_name = 'Regional Director';
			end if;
			if v_approving_head_designation = 'EVP' or
				v_approving_head_designation = 'VP' then
				set v_designation_name = 'Vice President';
			end if;
			
			if v_approving_head_designation = 'DM' then
				select concat(v_designation_name,
						': ',v_approving_head_name,'</br>' , 
						'DM Phone: ', v_phone_no,'</br>',
						v_store_personnel) into v_store_personnel;
			else
				select concat(v_designation_name,
						': ',v_approving_head_name,'</br>' , 
						v_store_personnel) into v_store_personnel;
			end if;
			
			
			if v_approving_head_designation = 'EVP' or 
				v_approving_head_designation = 'VP' then
				set v_true = 'T';
			end if; 
			if v_ctr > 2 then
				set v_true = 'T';
			end if;
		
	end while;  
	
RETURN (v_store_personnel);
END ;