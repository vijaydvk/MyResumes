-- Trinidad Angelita
-- Abdul Wahab

select a.id, a.employee_name, 
ifnull(concat( b.store_address, '</br>' , b.store_city, '</br>', 
b.store_state, '-', b.store_zip),'') as address, 
ifnull(b.location,'') as location, 
fn_hierarchy_get_dm_rd_vp(a.employee_name) as heades 
from cric_employee_hierarchy a, cric_stores_master b 
where a.designation_code in ('RSC','RSM')
and b.store_id_number = a.location_code
order by a.employee_name asc;

select a.employee_name, fn_hierarchy_get_dm_rd_vp(a.employee_name) as heads 
from cric_employee_hierarchy a 
where a.designation_code in ('RSC','RSM') 
and approving_head_designation not in ('FIN1','FIN2','FIN3')
-- and employee_name not in ('Bradley Joseph A')
order by a.employee_name 

DELIMITER $$

-- DROP FUNCTION fn_hierarchy_get_dm_rd_vp
 
CREATE FUNCTION fn_hierarchy_get_dm_rd_vp(p_employee_id varchar(120)) 
RETURNS VARCHAR(1200)
    DETERMINISTIC
BEGIN
    DECLARE v_dm_rd_vp varchar(1200);
	DECLARE v_employee_name varchar(120);
	DECLARE v_employee varchar(120);
	DECLARE v_approving_head_name varchar(120);
	DECLARE v_approving_head_designation varchar(120);
	DECLARE v_true char(1);
	DECLARE v_count int;
	DECLARE v_ctr int;
	
	set v_true = 'F';
	set v_dm_rd_vp = '';			
	set v_employee = p_employee_id;
	set v_ctr = 0;
	
	while v_true = 'F' DO
		set v_ctr = v_ctr + 1;
		set v_employee_name = (select ifnull(employee_name,'notfound') as employee_name
		from cric_employee_hierarchy
		where employee_id = v_employee
		and approving_head_id <> ''
		and approving_head_designation <> ''
		and designation_code <> approving_head_designation
		and employee_id <> approving_head_id
		and approving_head_designation not in ('FIN1','FIN2','FIN3','HomeOffice')
		union
		select 'notfound' as employee_name
		limit 1 )
		;
		
		/* 
		
		 insert into k18_error_log (company_id, user_id, error_log, createdon)
		 	values ('suncom1', v_employee_name, 'fn_hierarchy_get_dm_rd_vp', current_date());
		  */
			
		if v_employee_name = 'notfound' then
			set v_true = 'T';
		else
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
		
			select concat(v_dm_rd_vp,v_approving_head_designation,
						'-',v_approving_head_name,'</br>') into v_dm_rd_vp;
			 if v_approving_head_designation = 'EVP' or 
				v_approving_head_designation = 'VP' then
				set v_true = 'T';
			end if; 
		end if;
		
		/* if v_ctr > 1 then
			set v_dm_rd_vp = '';
			set v_ctr = 0;
			set v_true = 'T';
			
		end if; */

	end while;
	-- SELECT SUBSTRING_INDEX(v_dm_rd_vp,',',3) into v_dm_rd_vp;
	-- select TRIM(TRAILING  '</br>' FROM v_dm_rd_vp) into v_dm_rd_vp;
RETURN (v_dm_rd_vp);
END ;
