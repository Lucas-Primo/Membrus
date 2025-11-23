SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `membrus_schemas`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `membros`
--

CREATE TABLE `membros` (
  `ID` int(11) NOT NULL,
  `CPF` varchar(14) NOT NULL,
  `Nome_Completo` varchar(100) NOT NULL,
  `Data_Nascimento` date DEFAULT NULL,
  `Endereco` varchar(200) DEFAULT NULL,
  `CEP` varchar(9) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `senha` varchar(50)  DEFAULT NULL,
  `Celular` varchar(15) DEFAULT NULL,
  `Telefone` varchar(14) DEFAULT NULL,
  `Naturalidade` varchar(50) DEFAULT NULL,
  `Nacionalidade` varchar(50) DEFAULT 'Brasileira',
  `Batizado_Aguas` tinyint(1) DEFAULT 0,
  `Departamento` enum('Jovens','Senhoras','Missões','Crianças','Novos Convertidos','Varões','Adolescentes','Outro') DEFAULT NULL,
  `Cargo_Eclesiastico` enum('Membro','Diácono','Presbítero','Pastor','Missionário','Evangelista','Auxiliar','Líder','Coordenador') DEFAULT NULL,
  `Membro_Desde` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios_login`
--

CREATE TABLE `usuarios_login` (
  `ID` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Login` varchar(50) NOT NULL,
  `Senha` varchar(255) NOT NULL,
  `Data_Criacao` timestamp NOT NULL DEFAULT current_timestamp(),
  `Ultimo_Login` timestamp NULL DEFAULT NULL,
  `Ativo` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `membros`
--
ALTER TABLE `membros`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `CPF` (`CPF`);

--
-- Índices de tabela `usuarios_login`
--
ALTER TABLE `usuarios_login`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Username` (`Username`),
  ADD UNIQUE KEY `Login` (`Login`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `membros`
--
ALTER TABLE `membros`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuarios_login`
--
ALTER TABLE `usuarios_login`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
