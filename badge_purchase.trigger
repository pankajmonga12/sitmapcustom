DELIMITER //
CREATE TRIGGER badge_purchase

  AFTER INSERT

  ON orders

  FOR EACH ROW

BEGIN

  DECLARE p_status INT DEFAULT 0;

  select count(*) into p_status from email_purchase where txn_id = new.txnid;

  if p_status = 0 then

	insert into email_purchase(txn_id,purchase_date,sent_email_id) values (new.txnid,current_timestamp(),new.shipping_emailid);

  end if;


END;//