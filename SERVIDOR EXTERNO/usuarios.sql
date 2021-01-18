# Privilegios para `admin`@`localhost`

GRANT USAGE ON *.* TO `admin`@`localhost` IDENTIFIED BY PASSWORD '*4ACFE3202A5FF5CF467898FC58AAB1D615029441';

GRANT SELECT, INSERT, UPDATE, DELETE, DROP ON `covid\_paciente`.* TO `admin`@`localhost`;


# Privilegios para `paciente`@`localhost`

GRANT USAGE ON *.* TO `paciente`@`localhost` IDENTIFIED BY PASSWORD '*14F57843D3EDA0C1BAAE3AAA7C6CF4B627ECB763';

GRANT SELECT ON `covid\_paciente`.* TO `paciente`@`localhost`;


# Privilegios para `usuario`@`localhost`

GRANT USAGE ON *.* TO `usuario`@`localhost` IDENTIFIED BY PASSWORD '*96B0150C50489D818DA193ADB55F29A1E4C91D11';

GRANT SELECT, INSERT, UPDATE ON `covid\_paciente`.* TO `usuario`@`localhost`;
