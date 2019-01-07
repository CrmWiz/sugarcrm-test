-- basic mysql credential template
-- generated on 2019/01/07 15:36:11 for virtualhost sugardemo.crmwiz.co
-- user: sugardemo_crmwiz
-- pass: FAiKPDAmjP1k
-- db: sugardemo_crmwiz_co


-- mysqldump --create-options -h db.crmcluster.loadedtech.com.au -u sugardemo_crmwiz -pFAiKPDAmjP1k sugardemo_crmwiz_co > backup/sugardemo_crmwiz_co_timestamp.sql


CREATE DATABASE sugardemo_crmwiz_co CHARACTER SET='utf8';
CREATE USER 'sugardemo_crmwiz'@'%' IDENTIFIED BY 'FAiKPDAmjP1k';
CREATE USER 'sugardemo_crmwiz'@'localhost' IDENTIFIED BY 'FAiKPDAmjP1k';
GRANT ALL PRIVILEGES ON sugardemo_crmwiz_co.* TO 'sugardemo_crmwiz'@'%';
GRANT ALL PRIVILEGES ON sugardemo_crmwiz_co.* TO 'sugardemo_crmwiz'@'localhost';
