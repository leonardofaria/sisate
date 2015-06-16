/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table usuarios
# ------------------------------------------------------------

CREATE TABLE `usuarios` (
  `siape` varchar(7) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `nome` varchar(60) COLLATE latin1_general_ci DEFAULT NULL,
  `acesso` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `setor` varchar(8) COLLATE latin1_general_ci DEFAULT NULL,
  `privilegio` char(1) COLLATE latin1_general_ci DEFAULT NULL,
  `senha` varchar(15) COLLATE latin1_general_ci DEFAULT NULL,
  `prazo` char(3) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `magico` int(11) NOT NULL DEFAULT '0',
  `upag` varchar(9) COLLATE latin1_general_ci DEFAULT '000000000',
  `defvis` char(1) COLLATE latin1_general_ci DEFAULT 'N',
  `portaria` text COLLATE latin1_general_ci,
  `datapt` date DEFAULT NULL,
  `ptfim` text COLLATE latin1_general_ci,
  `dtfim` date DEFAULT NULL,
  `recalculo` char(1) COLLATE latin1_general_ci NOT NULL DEFAULT 'S' COMMENT 'Recalcula as horas de trabalho',
  `refaz_frqano` char(1) COLLATE latin1_general_ci NOT NULL DEFAULT 'S' COMMENT 'Remonta a ficha de frequencia anual',
  `nome_soundex` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`siape`),
  KEY `setor` (`setor`),
  KEY `pesquisa` (`siape`,`nome`),
  KEY `datapt` (`datapt`),
  KEY `dtfim` (`dtfim`),
  KEY `senha` (`senha`),
  KEY `acesso` (`acesso`),
  KEY `nome_soundex` (`nome_soundex`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;



# Dump of table vw_servidores
# ------------------------------------------------------------

CREATE TABLE `vw_servidores` (
  `siape` varchar(7) COLLATE latin1_general_ci NOT NULL DEFAULT '0000000',
  `nome` varchar(60) COLLATE latin1_general_ci DEFAULT NULL,
  `sexo` char(1) COLLATE latin1_general_ci DEFAULT NULL,
  `codigo_cargo` char(6) COLLATE latin1_general_ci DEFAULT NULL,
  `cargo` varchar(40) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `jornada` varchar(2) COLLATE latin1_general_ci DEFAULT NULL,
  `lotacao` varchar(8) COLLATE latin1_general_ci DEFAULT '00000000',
  `tb0700` varchar(8) COLLATE latin1_general_ci DEFAULT NULL,
  `lotacao_descricao` varchar(110) COLLATE latin1_general_ci DEFAULT NULL,
  `horario_de_entrada` time DEFAULT NULL,
  `saida_para_almoco` time DEFAULT NULL,
  `retorno_do_almoco` time DEFAULT NULL,
  `horario_de_saida` time DEFAULT NULL,
  `turno_estendido` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `chefia` varchar(1) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `email` varchar(80) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`siape`),
  KEY `nome` (`nome`),
  KEY `email` (`email`),
  KEY `cargo` (`cargo`),
  KEY `siape` (`siape`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
