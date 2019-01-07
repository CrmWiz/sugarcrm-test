-- basic mysql credential template
-- generated on 2019/01/07 15:36:11 for virtualhost sugardemo.crmwiz.co
-- user: sugardemo_crmwiz
-- pass: FAiKPDAmjP1k
-- db: sugardemo_crmwiz_co

DROP DATABASE sugardemo_crmwiz_co;
REVOKE ALL PRIVILEGES ON sugardemo_crmwiz_co.* FROM 'sugardemo_crmwiz'@'%';
REVOKE ALL PRIVILEGES ON sugardemo_crmwiz_co.* FROM 'sugardemo_crmwiz'@'localhost';
DROP USER 'sugardemo_crmwiz'@'%';
DROP USER 'sugardemo_crmwiz'@'localhost';
