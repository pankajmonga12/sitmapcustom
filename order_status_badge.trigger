DELIMITER //
CREATE TRIGGER order_status_badge
BEFORE UPDATE
ON orders
FOR EACH ROW
  BEGIN

  DECLARE purchase_count INT DEFAULT 0;



  IF old.status_order <> 3 AND new.status_order = 3
  THEN
    SET new.mail_notify = 3;
  END IF;

  IF old.status_order <> 4 AND new.status_order = 4
  THEN
    SET new.mail_notify = 4;
    SELECT COUNT(DISTINCT(txnid)) INTO purchase_count FROM orders WHERE user_id = new.user_id;
    CASE purchase_count

      WHEN 1
      THEN INSERT INTO badges(badge_type,user_id,badge_level,notification_text) VALUES(6,new.user_id,1,' The Newbie Shopper - 0 Star')  ON DUPLICATE KEY
    UPDATE badge_level=1, notification_text='The Newbie Shopper - 0 Star';
        UPDATE user_details SET bbucks = bbucks + 1500 WHERE user_id = new.user_id;

      WHEN 2
        THEN UPDATE badges, user_details SET badge_level =2,notification_text='The Newbie Shopper - 1 Star',notify_status = 0, bbucks = bbucks + 2500 WHERE badges.badge_type = 6 AND badges.user_id = new.user_id AND user_details.user_id = new.user_id;

      WHEN 3
        THEN UPDATE badges, user_details SET badge_level =3,notification_text='The Newbie Shopper - 2 Star',notify_status = 0, bbucks = bbucks + 3500 WHERE badges.badge_type = 6 and badges.user_id = new.user_id AND user_details.user_id = new.user_id;

      WHEN 4
        THEN UPDATE badges, user_details SET badge_level =4,notification_text='The Newbie Shopper - 3 Star',notify_status = 0, bbucks = bbucks + 4000 WHERE badges.badge_type = 6 and badges.user_id = new.user_id AND user_details.user_id = new.user_id;

      WHEN 5
        THEN UPDATE badges, user_details SET badge_level =5,notification_text='The Serious Shopper - 0 Star',notify_status = 0, bbucks = bbucks + 8000 WHERE badges.badge_type = 6 and badges.user_id = new.user_id AND user_details.user_id = new.user_id;

      WHEN 6
        THEN UPDATE badges, user_details SET badge_level =6,notification_text='The Serious Shopper - 1 Star',notify_status = 0, bbucks = bbucks + 10000 WHERE badges.badge_type = 6 and badges.user_id = new.user_id AND user_details.user_id = new.user_id;

      WHEN 7
        THEN UPDATE badges, user_details SET badge_level =7,notification_text='The Serious Shopper - 2 Star',notify_status = 0, bbucks = bbucks + 12000 WHERE badges.badge_type = 6 and badges.user_id = new.user_id AND user_details.user_id = new.user_id;

      WHEN 12
        THEN UPDATE badges, user_details SET badge_level =8,notification_text='The Serious Shopper - 3 Star',notify_status = 0, bbucks = bbucks + 15000 WHERE badges.badge_type = 6 and badges.user_id = new.user_id AND user_details.user_id = new.user_id;

      WHEN 15
        THEN UPDATE badges, user_details SET badge_level =9,notification_text='The Veteran Shopper - 0 Star',notify_status = 0, bbucks = bbucks + 20000 WHERE badges.badge_type = 6 and badges.user_id = new.user_id AND user_details.user_id = new.user_id;

      WHEN 20
        THEN UPDATE badges, user_details SET badge_level =10,notification_text='The Veteran Shopper - 1 Star',notify_status = 0, bbucks = bbucks + 25000 WHERE badges.badge_type = 6 and badges.user_id = new.user_id AND user_details.user_id = new.user_id;

      WHEN 25
        THEN UPDATE badges, user_details SET badge_level =11,notification_text='The Veteran Shopper - 2 Star',notify_status = 0, bbucks = bbucks + 35000 WHERE badges.badge_type = 6 and badges.user_id = new.user_id AND user_details.user_id = new.user_id;

      WHEN 30
        THEN UPDATE badges, user_details SET badge_level =12,notification_text='The Veteran Shopper - 3 Star',notify_status = 0, bbucks = bbucks + 45000 WHERE badges.badge_type = 6 and badges.user_id = new.user_id AND user_details.user_id = new.user_id;

      WHEN 45
        THEN UPDATE badges, user_details SET badge_level =13,notification_text='The Shopaholic - 0 Star',notify_status = 0, bbucks = bbucks + 55000 WHERE badges.badge_type = 6 and badges.user_id = new.user_id AND user_details.user_id = new.user_id;

      WHEN 50
        THEN UPDATE badges, user_details SET badge_level =14,notification_text='The Shopaholic - 1 Star',notify_status = 0, bbucks = bbucks + 75000 WHERE badges.badge_type = 6 and badges.user_id = new.user_id AND user_details.user_id = new.user_id;

      WHEN 65
        THEN UPDATE badges, user_details SET badge_level =15,notification_text='The Shopaholic - 2 Star',notify_status = 0, bbucks = bbucks + 100000 WHERE badges.badge_type = 6 and badges.user_id = new.user_id AND user_details.user_id = new.user_id;

      WHEN 100
        THEN UPDATE badges, user_details SET badge_level =16,notification_text='The Shopaholic - 3 Star',notify_status = 0, bbucks = bbucks + 125000 WHERE badges.badge_type = 6 and badges.user_id = new.user_id AND user_details.user_id = new.user_id;
      ELSE
        BEGIN
        END;
    END CASE;
  END if;

  IF old.status_order <> 5 AND new.status_order = 5
  THEN
    SET new.mail_notify = 5;
    UPDATE products SET quantity = quantity + old.quantity WHERE product_id = old.product_id;
  END IF;

  IF old.status_order <> 6 AND new.status_order = 6
  THEN
    SET new.mail_notify = 6;
  END IF;

  IF old.mail_notify = 3 AND new.mail_notify = 0
  THEN
    INSERT INTO order_shipped_mails( order_id, email_date, sent_email_id )
      VALUES ( old.order_id, current_timestamp(), old.shipping_emailid );
  END IF;

  IF old.mail_notify = 5 AND new.mail_notify = 0
  THEN
    INSERT INTO order_cancelled_mails( order_id, email_date, sent_email_id )
      VALUES ( old.order_id, current_timestamp(), old.shipping_emailid );
  END IF;


END;//