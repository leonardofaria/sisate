/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table ci_sessions
# ------------------------------------------------------------

CREATE TABLE `ci_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table eventos
# ------------------------------------------------------------

DROP TABLE IF EXISTS `eventos`;

CREATE TABLE `eventos` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL DEFAULT '',
  `perfil_id` int(11) NOT NULL,
  `ativo` char(1) NOT NULL DEFAULT 'S',
  `documento` char(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `eventos` WRITE;
/*!40000 ALTER TABLE `eventos` DISABLE KEYS */;

INSERT INTO `eventos` (`id`, `nome`, `perfil_id`, `ativo`, `documento`)
VALUES
	(1,'Cadastramento',2,'S','N'),
	(2,'Encaminhamento',2,'S','N'),
	(3,'Documento juntado',2,'S','N'),
	(4,'Distribuir para análise',3,'S','N'),
	(5,'Redistribuir para análise',3,'S','N'),
	(6,'Análise concluída',4,'S','S'),
	(7,'Cadastramento de exigência',4,'S','S'),
	(8,'Encaminhamento',3,'S','N'),
	(100,'Arquivar',2,'S','N');

/*!40000 ALTER TABLE `eventos` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table modalidades
# ------------------------------------------------------------

DROP TABLE IF EXISTS `modalidades`;

CREATE TABLE `modalidades` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `modalidades` WRITE;
/*!40000 ALTER TABLE `modalidades` DISABLE KEYS */;

INSERT INTO `modalidades` (`id`, `nome`)
VALUES
	(1,'Agência da Previdência Social'),
	(2,'Serviço de Saúde do Trabalhador');

/*!40000 ALTER TABLE `modalidades` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table orgaos
# ------------------------------------------------------------

DROP TABLE IF EXISTS `orgaos`;

CREATE TABLE `orgaos` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `ol` int(8) DEFAULT NULL,
  `modalidade_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `orgaos` WRITE;
/*!40000 ALTER TABLE `orgaos` DISABLE KEYS */;

INSERT INTO `orgaos` (`id`, `nome`, `ol`, `modalidade_id`)
VALUES
	(1,'APS DIVINOPOLIS',11023020,1),
	(2,'APS ITAUNA',11023010,1),
	(3,'SECAO DE SAUDE DO TRABALHADOR',11423000,2),
	(8,'GERENCIA EXECUTIVA DIVINOPOLIS',11023000,1),
	(11,'AGENCIA DA PREVIDENCIA SOCIAL BARRA MANSA',17025030,1),
	(12,'AGENCIA DA PREVIDENCIA SOCIAL RIO BONITO',17023090,1),
	(13,'AGENCIA DA PREVIDENCIA SOCIAL ATENDIMENTO DE DEMANDAS JUDICIAIS NITEROI',17023210,1),
	(14,'APS CABO FRIO',17023020,1),
	(15,'APS CANTAGALO',17024080,1),
	(16,'APS ARRAIAL DO CABO',17023130,1),
	(17,'APS RIO DE JANEIRO-CENTRO',17001020,1),
	(18,'APS BRASILIA-TAGUATINGA',23001060,1);

/*!40000 ALTER TABLE `orgaos` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table perfis
# ------------------------------------------------------------

DROP TABLE IF EXISTS `perfis`;

CREATE TABLE `perfis` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `perfis` WRITE;
/*!40000 ALTER TABLE `perfis` DISABLE KEYS */;

INSERT INTO `perfis` (`id`, `nome`)
VALUES
	(1,'ADMINISTRADOR'),
	(2,'SERVIDOR DE APS'),
	(3,'GESTOR DO SST'),
	(4,'MEDICO PERITO');

/*!40000 ALTER TABLE `perfis` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table processos
# ------------------------------------------------------------

CREATE TABLE `processos` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nb` varchar(12) DEFAULT NULL,
  `ctc` varchar(17) DEFAULT NULL,
  `criado` datetime DEFAULT NULL,
  `modificado` datetime DEFAULT NULL,
  `orgaoresponsavel_id` int(11) DEFAULT NULL,
  `orgaoatual_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table processos_eventos
# ------------------------------------------------------------

CREATE TABLE `processos_eventos` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `processo_id` int(11) DEFAULT NULL,
  `evento_id` int(11) DEFAULT NULL,
  `complemento` varchar(255) DEFAULT NULL,
  `criado` datetime DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table usuarios
# ------------------------------------------------------------

CREATE TABLE `usuarios` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `siape` varchar(7) DEFAULT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `criado` datetime DEFAULT NULL,
  `orgao_id` int(11) DEFAULT NULL,
  `perfil_id` int(11) DEFAULT NULL,
  `ativo` tinyint(1) DEFAULT '1',
  `ultimoacesso` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
