drop database bdds7;

CREATE DATABASE bdds7;

USE bdds7;

-- Crear la tabla Usuario
CREATE TABLE Usuario (
    UsuarioID INT AUTO_INCREMENT PRIMARY KEY,
    Nombre VARCHAR(50) NOT NULL,
    Apellido VARCHAR(50) NOT NULL,
    CorreoElectronico VARCHAR(100) UNIQUE NOT NULL,
    Contrasena VARCHAR(255) NOT NULL,
	TipoUsuario ENUM('ordinario', 'administrador') NOT NULL
);

-- Crear la tabla Computadora
CREATE TABLE Computadora (
    PcID INT AUTO_INCREMENT PRIMARY KEY,
	LabID INT NOT NULL,
    Nombre VARCHAR(50) NOT NULL,
    Estado ENUM('disponible', 'reservado') NOT NULL,
	FOREIGN KEY (LabID) REFERENCES Laboratorio(LabID)
);

-- Crear la tabla Reserva
CREATE TABLE Reserva (
    ReservaID INT AUTO_INCREMENT PRIMARY KEY,
    UsuarioID INT NOT NULL,
    PcID INT NOT NULL,
    FechaReserva DATE NOT NULL,
    HoraInicio TIME NOT NULL,
    HoraFinalizacion TIME NOT NULL,
	FOREIGN KEY (UsuarioID) REFERENCES Usuario(UsuarioID),
	FOREIGN KEY (PcID) REFERENCES Computadora(PcID)
);

-- Crear la tabla de laboratorio
CREATE TABLE Laboratorio (
	LabID INT AUTO_INCREMENT PRIMARY KEY,
	Lab_No VARCHAR(50) NOT NULL
);
