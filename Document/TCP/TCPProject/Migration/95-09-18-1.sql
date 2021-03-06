USE [master]
GO
/****** Object:  Database [Test]    Script Date: 08/12/2016 12:37:20 ب.ظ ******/
CREATE DATABASE [Test]
 CONTAINMENT = NONE
 ON  PRIMARY 
( NAME = N'Test', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL12.MSSQLSERVER\MSSQL\DATA\Test.mdf' , SIZE = 4096KB , MAXSIZE = UNLIMITED, FILEGROWTH = 1024KB )
 LOG ON 
( NAME = N'Test_log', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL12.MSSQLSERVER\MSSQL\DATA\Test_log.ldf' , SIZE = 1024KB , MAXSIZE = 2048GB , FILEGROWTH = 10%)
GO
ALTER DATABASE [Test] SET COMPATIBILITY_LEVEL = 100
GO
IF (1 = FULLTEXTSERVICEPROPERTY('IsFullTextInstalled'))
begin
EXEC [Test].[dbo].[sp_fulltext_database] @action = 'enable'
end
GO
ALTER DATABASE [Test] SET ANSI_NULL_DEFAULT OFF 
GO
ALTER DATABASE [Test] SET ANSI_NULLS OFF 
GO
ALTER DATABASE [Test] SET ANSI_PADDING OFF 
GO
ALTER DATABASE [Test] SET ANSI_WARNINGS OFF 
GO
ALTER DATABASE [Test] SET ARITHABORT OFF 
GO
ALTER DATABASE [Test] SET AUTO_CLOSE OFF 
GO
ALTER DATABASE [Test] SET AUTO_SHRINK OFF 
GO
ALTER DATABASE [Test] SET AUTO_UPDATE_STATISTICS ON 
GO
ALTER DATABASE [Test] SET CURSOR_CLOSE_ON_COMMIT OFF 
GO
ALTER DATABASE [Test] SET CURSOR_DEFAULT  GLOBAL 
GO
ALTER DATABASE [Test] SET CONCAT_NULL_YIELDS_NULL OFF 
GO
ALTER DATABASE [Test] SET NUMERIC_ROUNDABORT OFF 
GO
ALTER DATABASE [Test] SET QUOTED_IDENTIFIER OFF 
GO
ALTER DATABASE [Test] SET RECURSIVE_TRIGGERS OFF 
GO
ALTER DATABASE [Test] SET  DISABLE_BROKER 
GO
ALTER DATABASE [Test] SET AUTO_UPDATE_STATISTICS_ASYNC OFF 
GO
ALTER DATABASE [Test] SET DATE_CORRELATION_OPTIMIZATION OFF 
GO
ALTER DATABASE [Test] SET TRUSTWORTHY OFF 
GO
ALTER DATABASE [Test] SET ALLOW_SNAPSHOT_ISOLATION OFF 
GO
ALTER DATABASE [Test] SET PARAMETERIZATION SIMPLE 
GO
ALTER DATABASE [Test] SET READ_COMMITTED_SNAPSHOT OFF 
GO
ALTER DATABASE [Test] SET HONOR_BROKER_PRIORITY OFF 
GO
ALTER DATABASE [Test] SET RECOVERY FULL 
GO
ALTER DATABASE [Test] SET  MULTI_USER 
GO
ALTER DATABASE [Test] SET PAGE_VERIFY CHECKSUM  
GO
ALTER DATABASE [Test] SET DB_CHAINING OFF 
GO
ALTER DATABASE [Test] SET FILESTREAM( NON_TRANSACTED_ACCESS = OFF ) 
GO
ALTER DATABASE [Test] SET TARGET_RECOVERY_TIME = 0 SECONDS 
GO
ALTER DATABASE [Test] SET DELAYED_DURABILITY = DISABLED 
GO
EXEC sys.sp_db_vardecimal_storage_format N'Test', N'ON'
GO
USE [Test]
GO
/****** Object:  User [admin]    Script Date: 08/12/2016 12:37:21 ب.ظ ******/
CREATE USER [admin] FOR LOGIN [admin] WITH DEFAULT_SCHEMA=[dbo]
GO
ALTER ROLE [db_owner] ADD MEMBER [admin]
GO
/****** Object:  Table [dbo].[gitdevice]    Script Date: 08/12/2016 12:37:21 ب.ظ ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[gitdevice](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[ipmain] [nvarchar](50) NOT NULL,
	[ipforegin] [nvarchar](50) NOT NULL,
	[namedevice] [nvarchar](50) NOT NULL,
	[active] [bit] NOT NULL,
	[zoon] [nvarchar](50) NOT NULL,
	[direction] [int] NOT NULL,
	[gen] [int] NOT NULL,
	[netStatus] [bit] NOT NULL,
	[timpssage] [int] NOT NULL,
	[timserver] [int] NOT NULL,
 CONSTRAINT [PK_gitdevice] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[gitlog]    Script Date: 08/12/2016 12:37:21 ب.ظ ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[gitlog](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[stu_id] [nvarchar](50) NOT NULL,
	[nam] [nvarchar](50) NOT NULL,
	[pic] [nvarchar](50) NULL,
	[direction] [int] NOT NULL,
	[tim] [smalldatetime] NOT NULL,
	[dat] [datetime] NOT NULL,
	[deviceId] [int] NOT NULL,
	[typepass] [int] NULL,
	[commentId] [int] NOT NULL,
 CONSTRAINT [PK_gitlog] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[gitlogOperator]    Script Date: 08/12/2016 12:37:21 ب.ظ ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[gitlogOperator](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[ip] [nvarchar](50) NOT NULL,
	[us] [nvarchar](50) NOT NULL,
	[tim] [smalldatetime] NULL,
	[dat] [datetime] NOT NULL,
	[msgopId] [int] NOT NULL,
	[descript] [nvarchar](1000) NULL,
 CONSTRAINT [PK_gitlogOperator] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[gitmessage]    Script Date: 08/12/2016 12:37:21 ب.ظ ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[gitmessage](
	[id] [int] NOT NULL,
	[message] [nvarchar](50) NOT NULL,
 CONSTRAINT [PK_gitmessage] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[gitmsgOperator]    Script Date: 08/12/2016 12:37:21 ب.ظ ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[gitmsgOperator](
	[id] [int] NOT NULL,
	[messageUser] [nvarchar](1000) NOT NULL,
 CONSTRAINT [PK_gitmegOperator] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[gitoperator]    Script Date: 08/12/2016 12:37:21 ب.ظ ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[gitoperator](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[nam] [nvarchar](50) NOT NULL,
	[fam] [nvarchar](50) NOT NULL,
	[us] [nvarchar](50) NOT NULL,
	[pass] [nvarchar](50) NOT NULL,
	[timshowpic] [int] NOT NULL,
	[recordcount] [int] NOT NULL,
	[datcreate] [datetime] NOT NULL,
 CONSTRAINT [PK_gitoperator] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[gitoption]    Script Date: 08/12/2016 12:37:21 ب.ظ ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[gitoption](
	[datstartsuit] [datetime] NOT NULL,
	[pdatstartsuit] [nvarchar](50) NULL,
	[datendsuit] [datetime] NOT NULL,
	[pdatendsuit] [nvarchar](50) NULL,
	[genzoonw] [int] NOT NULL,
	[genzoonm] [int] NOT NULL,
	[emergency] [int] NOT NULL,
	[port] [int] NULL
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[gitpermit]    Script Date: 08/12/2016 12:37:21 ب.ظ ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[gitpermit](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[deviceId] [int] NOT NULL,
	[operatorId] [int] NOT NULL,
 CONSTRAINT [PK_gitpermit] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[gituser]    Script Date: 08/12/2016 12:37:21 ب.ظ ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[gituser](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[stu_id] [nvarchar](50) NOT NULL,
	[cdn] [nvarchar](50) NOT NULL,
	[nam] [nvarchar](50) NOT NULL,
	[fam] [nvarchar](50) NOT NULL,
	[gen] [int] NOT NULL,
	[suitmem] [int] NOT NULL,
	[suitname] [nvarchar](50) NOT NULL,
	[pic] [nvarchar](50) NULL,
	[startdat] [datetime] NOT NULL,
	[pstartdat] [nvarchar](50) NULL,
	[enddat] [datetime] NOT NULL,
	[penddat] [nvarchar](50) NULL,
	[active] [bit] NOT NULL,
	[typepass] [int] NULL,
	[type] [int] NOT NULL,
	[comment] [nvarchar](1000) NULL,
 CONSTRAINT [PK_gituser] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[HC.direction]    Script Date: 08/12/2016 12:37:21 ب.ظ ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[HC.direction](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[code] [int] NULL,
	[name] [nvarchar](50) NOT NULL,
 CONSTRAINT [PK_HC.direction] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[tbreqguest]    Script Date: 08/12/2016 12:37:21 ب.ظ ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tbreqguest](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[stu_id] [nvarchar](50) NOT NULL,
	[nam] [nvarchar](50) NOT NULL,
	[fam] [nvarchar](50) NOT NULL,
	[kind] [int] NOT NULL,
	[stuguest] [nvarchar](50) NULL,
	[namguest] [nvarchar](50) NULL,
	[cdnguest] [nvarchar](50) NULL,
	[nesbat] [nvarchar](50) NULL,
	[dats] [datetime] NULL,
	[pdats] [nvarchar](50) NULL,
	[datf] [datetime] NULL,
	[pdatf] [nvarchar](50) NULL,
	[cday] [int] NULL,
	[nesbatdet] [nvarchar](50) NULL,
	[status] [int] NULL,
	[dat] [datetime] NULL,
	[pdat] [nvarchar](50) NULL,
	[suitx] [int] NULL,
	[modirnam] [nvarchar](50) NULL,
	[commodir] [nvarchar](max) NULL,
 CONSTRAINT [PK_tbreqguest] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]

GO
SET IDENTITY_INSERT [dbo].[gitdevice] ON 

GO
INSERT [dbo].[gitdevice] ([id], [ipmain], [ipforegin], [namedevice], [active], [zoon], [direction], [gen], [netStatus], [timpssage], [timserver]) VALUES (2, N'10.9.19.12', N'10.9.19.13', N'شماره 2 - ورود', 0, N'0', 0, 0, 1, 3, 5)
GO
INSERT [dbo].[gitdevice] ([id], [ipmain], [ipforegin], [namedevice], [active], [zoon], [direction], [gen], [netStatus], [timpssage], [timserver]) VALUES (5, N'10.9.19.13', N'10.9.19.12', N'شماره 2 - خروج', 1, N'0', 1, 0, 0, 3, 5)
GO
INSERT [dbo].[gitdevice] ([id], [ipmain], [ipforegin], [namedevice], [active], [zoon], [direction], [gen], [netStatus], [timpssage], [timserver]) VALUES (6, N'10.9.19.14', N'10.9.19.15', N'شماره 3 - ورود', 0, N'0', 0, 0, 1, 3, 5)
GO
INSERT [dbo].[gitdevice] ([id], [ipmain], [ipforegin], [namedevice], [active], [zoon], [direction], [gen], [netStatus], [timpssage], [timserver]) VALUES (7, N'10.9.19.15', N'10.9.19.14', N'شماره 3 - خروج', 0, N'0', 1, 0, 1, 2, 3)
GO
INSERT [dbo].[gitdevice] ([id], [ipmain], [ipforegin], [namedevice], [active], [zoon], [direction], [gen], [netStatus], [timpssage], [timserver]) VALUES (8, N'10.9.19.16', N'10.9.19.17', N'شماره 4 - ورود', 0, N'0', 0, 0, 1, 2, 2)
GO
INSERT [dbo].[gitdevice] ([id], [ipmain], [ipforegin], [namedevice], [active], [zoon], [direction], [gen], [netStatus], [timpssage], [timserver]) VALUES (9, N'10.9.19.17', N'10.9.19.16', N'شماره 4 - خروج', 0, N'0', 1, 0, 1, 3, 3)
GO
INSERT [dbo].[gitdevice] ([id], [ipmain], [ipforegin], [namedevice], [active], [zoon], [direction], [gen], [netStatus], [timpssage], [timserver]) VALUES (10, N'10.9.19.18', N'10.9.19.19', N'شماره 5 - ورود', 0, N'0', 0, 0, 1, 5, 5)
GO
INSERT [dbo].[gitdevice] ([id], [ipmain], [ipforegin], [namedevice], [active], [zoon], [direction], [gen], [netStatus], [timpssage], [timserver]) VALUES (11, N'10.9.19.19', N'10.9.19.28', N'شماره 5 - خروج', 0, N'0', 1, 0, 1, 5, 5)
GO
INSERT [dbo].[gitdevice] ([id], [ipmain], [ipforegin], [namedevice], [active], [zoon], [direction], [gen], [netStatus], [timpssage], [timserver]) VALUES (12, N'10.9.19.20', N'10.9.19.21', N'شماره 6- ورود', 0, N'0', 0, 0, 1, 5, 5)
GO
INSERT [dbo].[gitdevice] ([id], [ipmain], [ipforegin], [namedevice], [active], [zoon], [direction], [gen], [netStatus], [timpssage], [timserver]) VALUES (13, N'10.9.19.21', N'10.9.19.20', N'شماره 6 - خروج', 0, N'0', 1, 0, 1, 5, 5)
GO
INSERT [dbo].[gitdevice] ([id], [ipmain], [ipforegin], [namedevice], [active], [zoon], [direction], [gen], [netStatus], [timpssage], [timserver]) VALUES (14, N'10.9.19.22', N'10.9.19.23', N'شماره 7 - ورود', 0, N'0', 0, 0, 1, 5, 5)
GO
INSERT [dbo].[gitdevice] ([id], [ipmain], [ipforegin], [namedevice], [active], [zoon], [direction], [gen], [netStatus], [timpssage], [timserver]) VALUES (15, N'10.9.19.23', N'10.9.19.22', N'شماره 7 - خروج', 0, N'0', 1, 0, 1, 5, 5)
GO
INSERT [dbo].[gitdevice] ([id], [ipmain], [ipforegin], [namedevice], [active], [zoon], [direction], [gen], [netStatus], [timpssage], [timserver]) VALUES (16, N'10.9.19.24', N'10.9.19.25', N'شماره 8- ورود', 0, N'0', 0, 0, 1, 5, 5)
GO
INSERT [dbo].[gitdevice] ([id], [ipmain], [ipforegin], [namedevice], [active], [zoon], [direction], [gen], [netStatus], [timpssage], [timserver]) VALUES (17, N'10.9.19.25', N'10.9.19.24', N'شماره 8 - خروج', 0, N'0', 1, 0, 1, 5, 5)
GO
INSERT [dbo].[gitdevice] ([id], [ipmain], [ipforegin], [namedevice], [active], [zoon], [direction], [gen], [netStatus], [timpssage], [timserver]) VALUES (18, N'10.9.19.26', N'10.9.19.27', N'شماره 1 - ورود', 0, N'0', 0, 0, 1, 5, 5)
GO
INSERT [dbo].[gitdevice] ([id], [ipmain], [ipforegin], [namedevice], [active], [zoon], [direction], [gen], [netStatus], [timpssage], [timserver]) VALUES (19, N'10.9.19.27', N'10.9.19.26', N'شماره 1 - خروج', 0, N'0', 1, 0, 1, 5, 5)
GO
INSERT [dbo].[gitdevice] ([id], [ipmain], [ipforegin], [namedevice], [active], [zoon], [direction], [gen], [netStatus], [timpssage], [timserver]) VALUES (20, N'127.0.0.1', N'127.0.0.1', N'تست', 0, N'0', 1, 0, 0, 2, 2)
GO
INSERT [dbo].[gitdevice] ([id], [ipmain], [ipforegin], [namedevice], [active], [zoon], [direction], [gen], [netStatus], [timpssage], [timserver]) VALUES (23, N'127.0.0.1', N'127.0.0.1', N'تست', 0, N'0', 0, 0, 0, 2, 2)
GO
SET IDENTITY_INSERT [dbo].[gitdevice] OFF
GO
SET IDENTITY_INSERT [dbo].[gitlog] ON 

GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (997, N'1395', N'علی محمدی', NULL, 1, CAST(N'2016-12-07 09:16:00' AS SmallDateTime), CAST(N'2016-12-07 09:16:06.673' AS DateTime), 13, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (998, N'1395', N'علی محمدی', NULL, 1, CAST(N'2016-12-07 09:18:00' AS SmallDateTime), CAST(N'2016-12-07 09:18:08.440' AS DateTime), 11, NULL, 15)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1001, N'1395', N'علی محمدی', NULL, 1, CAST(N'2016-12-07 09:25:00' AS SmallDateTime), CAST(N'2016-12-07 09:25:23.890' AS DateTime), 11, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1002, N'1395', N'علی محمدی', NULL, 1, CAST(N'2016-12-07 09:25:00' AS SmallDateTime), CAST(N'2016-12-07 09:25:26.173' AS DateTime), 13, NULL, 15)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1003, N'1395', N'علی محمدی', NULL, 0, CAST(N'2016-12-07 09:25:00' AS SmallDateTime), CAST(N'2016-12-07 09:25:29.877' AS DateTime), 10, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1004, N'1395', N'علی محمدی', NULL, 1, CAST(N'2016-12-07 09:25:00' AS SmallDateTime), CAST(N'2016-12-07 09:25:33.437' AS DateTime), 11, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1005, N'1395', N'علی محمدی', NULL, 1, CAST(N'2016-12-07 09:25:00' AS SmallDateTime), CAST(N'2016-12-07 09:25:34.733' AS DateTime), 13, NULL, 15)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1006, N'1395', N'علی محمدی', NULL, 1, CAST(N'2016-12-07 09:25:00' AS SmallDateTime), CAST(N'2016-12-07 09:25:39.017' AS DateTime), 11, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1007, N'1395', N'علی محمدی', NULL, 0, CAST(N'2016-12-07 09:25:00' AS SmallDateTime), CAST(N'2016-12-07 09:25:43.987' AS DateTime), 10, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1008, N'1395', N'علی محمدی', NULL, 1, CAST(N'2016-12-07 09:25:00' AS SmallDateTime), CAST(N'2016-12-07 09:25:47.220' AS DateTime), 13, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1009, N'1395', N'علی محمدی', NULL, 1, CAST(N'2016-12-07 09:25:00' AS SmallDateTime), CAST(N'2016-12-07 09:25:48.627' AS DateTime), 15, NULL, 15)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1010, N'1395', N'علی محمدی', NULL, 1, CAST(N'2016-12-07 09:25:00' AS SmallDateTime), CAST(N'2016-12-07 09:25:50.033' AS DateTime), 17, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1011, N'1395', N'علی محمدی', NULL, 1, CAST(N'2016-12-07 09:25:00' AS SmallDateTime), CAST(N'2016-12-07 09:25:59.330' AS DateTime), 11, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1012, N'1395', N'علی محمدی', NULL, 1, CAST(N'2016-12-07 09:26:00' AS SmallDateTime), CAST(N'2016-12-07 09:26:00.783' AS DateTime), 13, NULL, 15)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1013, N'1395', N'علی محمدی', NULL, 1, CAST(N'2016-12-07 09:27:00' AS SmallDateTime), CAST(N'2016-12-07 09:27:02.407' AS DateTime), 11, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1014, N'1395', N'علی محمدی', NULL, 1, CAST(N'2016-12-07 09:43:00' AS SmallDateTime), CAST(N'2016-12-07 09:43:02.093' AS DateTime), 11, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1015, N'1395', N'علی محمدی', NULL, 1, CAST(N'2016-12-07 09:43:00' AS SmallDateTime), CAST(N'2016-12-07 09:43:03.813' AS DateTime), 13, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1016, N'1395', N'علی محمدی', NULL, 0, CAST(N'2016-12-07 09:43:00' AS SmallDateTime), CAST(N'2016-12-07 09:43:09.940' AS DateTime), 10, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1017, N'1395', N'علی محمدی', NULL, 0, CAST(N'2016-12-07 09:43:00' AS SmallDateTime), CAST(N'2016-12-07 09:43:12.750' AS DateTime), 12, NULL, 15)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1018, N'1395', N'علی محمدی', NULL, 0, CAST(N'2016-12-07 09:43:00' AS SmallDateTime), CAST(N'2016-12-07 09:43:15.610' AS DateTime), 14, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1019, N'1395', N'علی محمدی', NULL, 1, CAST(N'2016-12-07 09:43:00' AS SmallDateTime), CAST(N'2016-12-07 09:43:19.017' AS DateTime), 15, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1020, N'1395', N'علی محمدی', NULL, 1, CAST(N'2016-12-07 09:43:00' AS SmallDateTime), CAST(N'2016-12-07 09:43:20.377' AS DateTime), 13, NULL, 15)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1021, N'1395', N'علی محمدی', NULL, 0, CAST(N'2016-12-07 09:43:00' AS SmallDateTime), CAST(N'2016-12-07 09:43:25.533' AS DateTime), 12, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1022, N'1395', N'علی محمدی', NULL, 1, CAST(N'2016-12-07 09:43:00' AS SmallDateTime), CAST(N'2016-12-07 09:43:29.737' AS DateTime), 11, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1023, N'1395', N'علی محمدی', NULL, 1, CAST(N'2016-12-07 09:43:00' AS SmallDateTime), CAST(N'2016-12-07 09:43:31.987' AS DateTime), 13, NULL, 15)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1024, N'1395', N'علی محمدی', NULL, 1, CAST(N'2016-12-07 09:43:00' AS SmallDateTime), CAST(N'2016-12-07 09:43:36.343' AS DateTime), 11, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1025, N'1395', N'علی محمدی', NULL, 0, CAST(N'2016-12-07 09:43:00' AS SmallDateTime), CAST(N'2016-12-07 09:43:44.390' AS DateTime), 10, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1026, N'1395', N'علی محمدی', NULL, 1, CAST(N'2016-12-07 09:44:00' AS SmallDateTime), CAST(N'2016-12-07 09:44:02.127' AS DateTime), 11, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1027, N'1314', N'فاطمه داوودی', NULL, 1, CAST(N'2016-12-07 09:44:00' AS SmallDateTime), CAST(N'2016-12-07 09:44:02.750' AS DateTime), 13, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1028, N'1395', N'علی محمدی', NULL, 0, CAST(N'2016-12-07 09:44:00' AS SmallDateTime), CAST(N'2016-12-07 09:44:06.547' AS DateTime), 12, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1029, N'1314', N'فاطمه داوودی', NULL, 0, CAST(N'2016-12-07 09:44:00' AS SmallDateTime), CAST(N'2016-12-07 09:44:09.127' AS DateTime), 10, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1030, N'1395', N'علی محمدی', NULL, 1, CAST(N'2016-12-07 09:44:00' AS SmallDateTime), CAST(N'2016-12-07 09:44:14.000' AS DateTime), 13, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1031, N'1314', N'فاطمه داوودی', NULL, 1, CAST(N'2016-12-07 09:44:00' AS SmallDateTime), CAST(N'2016-12-07 09:44:14.843' AS DateTime), 15, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1032, N'1314', N'فاطمه داوودی', NULL, 0, CAST(N'2016-12-07 09:44:00' AS SmallDateTime), CAST(N'2016-12-07 09:44:20.407' AS DateTime), 12, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1033, N'1395', N'علی محمدی', NULL, 1, CAST(N'2016-12-07 09:44:00' AS SmallDateTime), CAST(N'2016-12-07 09:44:23.893' AS DateTime), 13, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1034, N'1395', N'علی محمدی', NULL, 1, CAST(N'2016-12-07 09:44:00' AS SmallDateTime), CAST(N'2016-12-07 09:44:44.783' AS DateTime), 11, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1035, N'1314', N'فاطمه داوودی', NULL, 1, CAST(N'2016-12-07 09:44:00' AS SmallDateTime), CAST(N'2016-12-07 09:44:46.953' AS DateTime), 11, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1036, N'1314', N'فاطمه داوودی', NULL, 0, CAST(N'2016-12-07 09:44:00' AS SmallDateTime), CAST(N'2016-12-07 09:44:53.250' AS DateTime), 10, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1037, N'1314', N'فاطمه داوودی', NULL, 1, CAST(N'2016-12-07 09:44:00' AS SmallDateTime), CAST(N'2016-12-07 09:44:56.970' AS DateTime), 11, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1038, N'1314', N'فاطمه داوودی', NULL, 0, CAST(N'2016-12-07 09:45:00' AS SmallDateTime), CAST(N'2016-12-07 09:45:01.783' AS DateTime), 10, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1039, N'1314', N'فاطمه داوودی', NULL, 1, CAST(N'2016-12-07 09:45:00' AS SmallDateTime), CAST(N'2016-12-07 09:45:04.970' AS DateTime), 11, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1040, N'1314', N'فاطمه داوودی', NULL, 0, CAST(N'2016-12-07 09:45:00' AS SmallDateTime), CAST(N'2016-12-07 09:45:09.767' AS DateTime), 10, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1041, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 09:45:00' AS SmallDateTime), CAST(N'2016-12-07 09:45:41.160' AS DateTime), 11, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1042, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 09:46:00' AS SmallDateTime), CAST(N'2016-12-07 09:46:33.280' AS DateTime), 19, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1043, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 09:46:00' AS SmallDateTime), CAST(N'2016-12-07 09:46:45.407' AS DateTime), 19, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1044, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 09:46:00' AS SmallDateTime), CAST(N'2016-12-07 09:46:51.123' AS DateTime), 9, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1045, N'1316', N'محمد ندایی', NULL, 0, CAST(N'2016-12-07 09:46:00' AS SmallDateTime), CAST(N'2016-12-07 09:46:54.657' AS DateTime), 8, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1046, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 09:47:00' AS SmallDateTime), CAST(N'2016-12-07 09:47:01.000' AS DateTime), 19, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1047, N'1316', N'محمد ندایی', NULL, 0, CAST(N'2016-12-07 09:47:00' AS SmallDateTime), CAST(N'2016-12-07 09:47:24.720' AS DateTime), 8, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1048, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 09:47:00' AS SmallDateTime), CAST(N'2016-12-07 09:47:28.923' AS DateTime), 9, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1049, N'1316', N'محمد ندایی', NULL, 0, CAST(N'2016-12-07 09:47:00' AS SmallDateTime), CAST(N'2016-12-07 09:47:35.610' AS DateTime), 18, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1050, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 09:47:00' AS SmallDateTime), CAST(N'2016-12-07 09:47:39.500' AS DateTime), 19, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1051, N'1314', N'فاطمه داوودی', NULL, 1, CAST(N'2016-12-07 09:52:00' AS SmallDateTime), CAST(N'2016-12-07 09:52:22.673' AS DateTime), 5, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1052, N'1314', N'فاطمه داوودی', NULL, 0, CAST(N'2016-12-07 09:52:00' AS SmallDateTime), CAST(N'2016-12-07 09:52:26.830' AS DateTime), 2, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1053, N'1395', N'علی محمدی', NULL, 1, CAST(N'2016-12-07 09:52:00' AS SmallDateTime), CAST(N'2016-12-07 09:52:57.283' AS DateTime), 5, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1054, N'1395', N'علی محمدی', NULL, 1, CAST(N'2016-12-07 09:52:00' AS SmallDateTime), CAST(N'2016-12-07 09:52:59.800' AS DateTime), 9, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1055, N'1314', N'فاطمه داوودی', NULL, 1, CAST(N'2016-12-07 09:53:00' AS SmallDateTime), CAST(N'2016-12-07 09:53:01.673' AS DateTime), 9, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1056, N'1314', N'فاطمه داوودی', NULL, 1, CAST(N'2016-12-07 09:53:00' AS SmallDateTime), CAST(N'2016-12-07 09:53:08.860' AS DateTime), 9, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1057, N'1314', N'فاطمه داوودی', NULL, 0, CAST(N'2016-12-07 09:53:00' AS SmallDateTime), CAST(N'2016-12-07 09:53:13.360' AS DateTime), 8, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1058, N'1395', N'علی محمدی', NULL, 1, CAST(N'2016-12-07 09:53:00' AS SmallDateTime), CAST(N'2016-12-07 09:53:17.313' AS DateTime), 9, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1059, N'1314', N'فاطمه داوودی', NULL, 1, CAST(N'2016-12-07 09:53:00' AS SmallDateTime), CAST(N'2016-12-07 09:53:20.080' AS DateTime), 9, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1060, N'1314', N'فاطمه داوودی', NULL, 0, CAST(N'2016-12-07 09:53:00' AS SmallDateTime), CAST(N'2016-12-07 09:53:24.453' AS DateTime), 8, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1061, N'1314', N'فاطمه داوودی', NULL, 1, CAST(N'2016-12-07 09:53:00' AS SmallDateTime), CAST(N'2016-12-07 09:53:30.233' AS DateTime), 5, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1062, N'1314', N'فاطمه داوودی', NULL, 0, CAST(N'2016-12-07 09:53:00' AS SmallDateTime), CAST(N'2016-12-07 09:53:34.000' AS DateTime), 2, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1063, N'1314', N'فاطمه داوودی', NULL, 1, CAST(N'2016-12-07 10:05:00' AS SmallDateTime), CAST(N'2016-12-07 10:05:45.503' AS DateTime), 9, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1064, N'1314', N'فاطمه داوودی', NULL, 0, CAST(N'2016-12-07 10:05:00' AS SmallDateTime), CAST(N'2016-12-07 10:05:50.240' AS DateTime), 6, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1065, N'1314', N'فاطمه داوودی', NULL, 0, CAST(N'2016-12-07 10:06:00' AS SmallDateTime), CAST(N'2016-12-07 10:06:16.723' AS DateTime), 6, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1066, N'1314', N'فاطمه داوودی', NULL, 1, CAST(N'2016-12-07 10:06:00' AS SmallDateTime), CAST(N'2016-12-07 10:06:23.083' AS DateTime), 7, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1067, N'1314', N'فاطمه داوودی', NULL, 0, CAST(N'2016-12-07 10:06:00' AS SmallDateTime), CAST(N'2016-12-07 10:06:28.707' AS DateTime), 6, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1068, N'1314', N'فاطمه داوودی', NULL, 1, CAST(N'2016-12-07 10:06:00' AS SmallDateTime), CAST(N'2016-12-07 10:06:33.317' AS DateTime), 7, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1069, N'1314', N'فاطمه داوودی', NULL, 1, CAST(N'2016-12-07 10:06:00' AS SmallDateTime), CAST(N'2016-12-07 10:06:35.503' AS DateTime), 9, NULL, 15)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1070, N'1314', N'فاطمه داوودی', NULL, 1, CAST(N'2016-12-07 10:06:00' AS SmallDateTime), CAST(N'2016-12-07 10:06:38.850' AS DateTime), 9, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1071, N'1314', N'فاطمه داوودی', NULL, 1, CAST(N'2016-12-07 10:06:00' AS SmallDateTime), CAST(N'2016-12-07 10:06:47.177' AS DateTime), 7, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1072, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 10:07:00' AS SmallDateTime), CAST(N'2016-12-07 10:07:26.533' AS DateTime), 9, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1073, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 10:07:00' AS SmallDateTime), CAST(N'2016-12-07 10:07:50.410' AS DateTime), 9, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1074, N'1314', N'فاطمه داوودی', NULL, 1, CAST(N'2016-12-07 10:07:00' AS SmallDateTime), CAST(N'2016-12-07 10:07:50.550' AS DateTime), 7, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1075, N'1395', N'علی محمدی', NULL, 1, CAST(N'2016-12-07 10:07:00' AS SmallDateTime), CAST(N'2016-12-07 10:07:51.113' AS DateTime), 5, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1076, N'1316', N'محمد ندایی', NULL, 0, CAST(N'2016-12-07 10:08:00' AS SmallDateTime), CAST(N'2016-12-07 10:08:00.410' AS DateTime), 8, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1077, N'1395', N'علی محمدی', NULL, 0, CAST(N'2016-12-07 10:08:00' AS SmallDateTime), CAST(N'2016-12-07 10:08:00.563' AS DateTime), 2, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1078, N'1314', N'فاطمه داوودی', NULL, 0, CAST(N'2016-12-07 10:08:00' AS SmallDateTime), CAST(N'2016-12-07 10:08:00.597' AS DateTime), 6, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1079, N'1314', N'فاطمه داوودی', NULL, 1, CAST(N'2016-12-07 10:08:00' AS SmallDateTime), CAST(N'2016-12-07 10:08:04.660' AS DateTime), 7, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1080, N'1395', N'علی محمدی', NULL, 1, CAST(N'2016-12-07 10:08:00' AS SmallDateTime), CAST(N'2016-12-07 10:08:05.767' AS DateTime), 5, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1081, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 10:08:00' AS SmallDateTime), CAST(N'2016-12-07 10:08:05.847' AS DateTime), 9, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1082, N'1316', N'محمد ندایی', NULL, 0, CAST(N'2016-12-07 10:08:00' AS SmallDateTime), CAST(N'2016-12-07 10:08:12.830' AS DateTime), 8, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1083, N'1395', N'علی محمدی', NULL, 0, CAST(N'2016-12-07 10:08:00' AS SmallDateTime), CAST(N'2016-12-07 10:08:15.097' AS DateTime), 2, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1084, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 10:08:00' AS SmallDateTime), CAST(N'2016-12-07 10:08:17.720' AS DateTime), 9, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1085, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 10:11:00' AS SmallDateTime), CAST(N'2016-12-07 10:11:26.720' AS DateTime), 7, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1086, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 10:11:00' AS SmallDateTime), CAST(N'2016-12-07 10:11:28.280' AS DateTime), 9, NULL, 15)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1087, N'1316', N'محمد ندایی', NULL, 0, CAST(N'2016-12-07 10:11:00' AS SmallDateTime), CAST(N'2016-12-07 10:11:31.860' AS DateTime), 6, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1088, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 10:11:00' AS SmallDateTime), CAST(N'2016-12-07 10:11:39.313' AS DateTime), 9, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1089, N'1316', N'محمد ندایی', NULL, 0, CAST(N'2016-12-07 10:11:00' AS SmallDateTime), CAST(N'2016-12-07 10:11:51.297' AS DateTime), 8, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1090, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 10:11:00' AS SmallDateTime), CAST(N'2016-12-07 10:11:55.937' AS DateTime), 9, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1091, N'1395', N'علی محمدی', NULL, 1, CAST(N'2016-12-07 10:11:00' AS SmallDateTime), CAST(N'2016-12-07 10:11:56.733' AS DateTime), 7, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1092, N'1395', N'علی محمدی', NULL, 0, CAST(N'2016-12-07 10:12:00' AS SmallDateTime), CAST(N'2016-12-07 10:12:00.830' AS DateTime), 6, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1093, N'1316', N'محمد ندایی', NULL, 0, CAST(N'2016-12-07 10:12:00' AS SmallDateTime), CAST(N'2016-12-07 10:12:01.860' AS DateTime), 2, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1094, N'1395', N'علی محمدی', NULL, 1, CAST(N'2016-12-07 10:12:00' AS SmallDateTime), CAST(N'2016-12-07 10:12:06.080' AS DateTime), 7, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1095, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 10:12:00' AS SmallDateTime), CAST(N'2016-12-07 10:12:06.877' AS DateTime), 9, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1096, N'1395', N'علی محمدی', NULL, 0, CAST(N'2016-12-07 10:12:00' AS SmallDateTime), CAST(N'2016-12-07 10:12:12.297' AS DateTime), 8, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1097, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 10:12:00' AS SmallDateTime), CAST(N'2016-12-07 10:12:28.720' AS DateTime), 9, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1098, N'1395', N'علی محمدی', NULL, 1, CAST(N'2016-12-07 10:12:00' AS SmallDateTime), CAST(N'2016-12-07 10:12:29.377' AS DateTime), 7, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1099, N'1395', N'علی محمدی', NULL, 1, CAST(N'2016-12-07 10:13:00' AS SmallDateTime), CAST(N'2016-12-07 10:13:18.097' AS DateTime), 7, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1100, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 10:13:00' AS SmallDateTime), CAST(N'2016-12-07 10:13:18.737' AS DateTime), 9, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1101, N'1316', N'محمد ندایی', NULL, 0, CAST(N'2016-12-07 10:13:00' AS SmallDateTime), CAST(N'2016-12-07 10:13:24.673' AS DateTime), 6, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1102, N'1395', N'علی محمدی', NULL, 0, CAST(N'2016-12-07 10:13:00' AS SmallDateTime), CAST(N'2016-12-07 10:13:25.830' AS DateTime), 8, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1103, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 10:13:00' AS SmallDateTime), CAST(N'2016-12-07 10:13:32.737' AS DateTime), 9, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1104, N'1395', N'علی محمدی', NULL, 1, CAST(N'2016-12-07 10:13:00' AS SmallDateTime), CAST(N'2016-12-07 10:13:33.313' AS DateTime), 7, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1105, N'1395', N'علی محمدی', NULL, 0, CAST(N'2016-12-07 10:13:00' AS SmallDateTime), CAST(N'2016-12-07 10:13:37.440' AS DateTime), 6, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1106, N'1316', N'محمد ندایی', NULL, 0, CAST(N'2016-12-07 10:13:00' AS SmallDateTime), CAST(N'2016-12-07 10:13:38.470' AS DateTime), 2, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1107, N'1395', N'علی محمدی', NULL, 1, CAST(N'2016-12-07 10:13:00' AS SmallDateTime), CAST(N'2016-12-07 10:13:43.237' AS DateTime), 7, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1108, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 10:13:00' AS SmallDateTime), CAST(N'2016-12-07 10:13:43.987' AS DateTime), 9, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1109, N'1316', N'محمد ندایی', NULL, 0, CAST(N'2016-12-07 10:13:00' AS SmallDateTime), CAST(N'2016-12-07 10:13:48.627' AS DateTime), 2, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1110, N'1395', N'علی محمدی', NULL, 0, CAST(N'2016-12-07 10:13:00' AS SmallDateTime), CAST(N'2016-12-07 10:13:49.703' AS DateTime), 6, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1111, N'1395', N'علی محمدی', NULL, 1, CAST(N'2016-12-07 10:13:00' AS SmallDateTime), CAST(N'2016-12-07 10:13:53.453' AS DateTime), 7, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1112, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 10:13:00' AS SmallDateTime), CAST(N'2016-12-07 10:13:54.800' AS DateTime), 9, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1113, N'1395', N'علی محمدی', NULL, 1, CAST(N'2016-12-07 10:14:00' AS SmallDateTime), CAST(N'2016-12-07 10:14:00.627' AS DateTime), 7, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1114, N'1316', N'محمد ندایی', NULL, 0, CAST(N'2016-12-07 10:14:00' AS SmallDateTime), CAST(N'2016-12-07 10:14:05.970' AS DateTime), 8, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1115, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 10:14:00' AS SmallDateTime), CAST(N'2016-12-07 10:14:10.970' AS DateTime), 9, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1116, N'1395', N'علی محمدی', NULL, 1, CAST(N'2016-12-07 10:14:00' AS SmallDateTime), CAST(N'2016-12-07 10:14:11.203' AS DateTime), 7, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1117, N'1395', N'علی محمدی', NULL, 1, CAST(N'2016-12-07 10:14:00' AS SmallDateTime), CAST(N'2016-12-07 10:14:14.970' AS DateTime), 7, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1118, N'1395', N'علی محمدی', NULL, 1, CAST(N'2016-12-07 10:14:00' AS SmallDateTime), CAST(N'2016-12-07 10:14:17.563' AS DateTime), 9, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1119, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 10:14:00' AS SmallDateTime), CAST(N'2016-12-07 10:14:20.783' AS DateTime), 7, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1120, N'1395', N'علی محمدی', NULL, 0, CAST(N'2016-12-07 10:14:00' AS SmallDateTime), CAST(N'2016-12-07 10:14:24.447' AS DateTime), 8, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1121, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 10:14:00' AS SmallDateTime), CAST(N'2016-12-07 10:14:28.447' AS DateTime), 9, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1122, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 10:14:00' AS SmallDateTime), CAST(N'2016-12-07 10:14:31.387' AS DateTime), 7, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1123, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 10:14:00' AS SmallDateTime), CAST(N'2016-12-07 10:14:33.400' AS DateTime), 5, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1124, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 10:14:00' AS SmallDateTime), CAST(N'2016-12-07 10:14:36.150' AS DateTime), 5, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1125, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 10:14:00' AS SmallDateTime), CAST(N'2016-12-07 10:14:38.637' AS DateTime), 7, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1126, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 10:14:00' AS SmallDateTime), CAST(N'2016-12-07 10:14:40.353' AS DateTime), 9, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1127, N'1395', N'علی محمدی', NULL, 1, CAST(N'2016-12-07 10:14:00' AS SmallDateTime), CAST(N'2016-12-07 10:14:42.387' AS DateTime), 9, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1128, N'1395', N'علی محمدی', NULL, 0, CAST(N'2016-12-07 10:14:00' AS SmallDateTime), CAST(N'2016-12-07 10:14:47.590' AS DateTime), 8, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1129, N'1395', N'علی محمدی', NULL, 0, CAST(N'2016-12-07 10:14:00' AS SmallDateTime), CAST(N'2016-12-07 10:14:53.307' AS DateTime), 8, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1130, N'1395', N'علی محمدی', NULL, 0, CAST(N'2016-12-07 10:14:00' AS SmallDateTime), CAST(N'2016-12-07 10:14:58.447' AS DateTime), 6, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1131, N'0', N' ', NULL, 0, CAST(N'2016-12-07 10:15:00' AS SmallDateTime), CAST(N'2016-12-07 10:15:00.197' AS DateTime), 8, NULL, 11)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1132, N'0', N' ', NULL, 0, CAST(N'2016-12-07 10:15:00' AS SmallDateTime), CAST(N'2016-12-07 10:15:05.557' AS DateTime), 8, NULL, 11)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1133, N'0', N' ', NULL, 0, CAST(N'2016-12-07 10:15:00' AS SmallDateTime), CAST(N'2016-12-07 10:15:10.980' AS DateTime), 6, NULL, 11)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1134, N'1395', N'علی محمدی', NULL, 0, CAST(N'2016-12-07 10:15:00' AS SmallDateTime), CAST(N'2016-12-07 10:15:43.650' AS DateTime), 6, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1135, N'1395', N'علی محمدی', NULL, 1, CAST(N'2016-12-07 10:16:00' AS SmallDateTime), CAST(N'2016-12-07 10:16:01.793' AS DateTime), 5, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1136, N'1395', N'علی محمدی', NULL, 0, CAST(N'2016-12-07 10:16:00' AS SmallDateTime), CAST(N'2016-12-07 10:16:08.250' AS DateTime), 2, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1137, N'1395', N'علی محمدی', NULL, 0, CAST(N'2016-12-07 10:16:00' AS SmallDateTime), CAST(N'2016-12-07 10:16:18.487' AS DateTime), 2, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1138, N'1314', N'فاطمه داوودی', NULL, 1, CAST(N'2016-12-07 10:22:00' AS SmallDateTime), CAST(N'2016-12-07 10:22:24.253' AS DateTime), 19, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1139, N'1395', N'علی محمدی', NULL, 1, CAST(N'2016-12-07 10:22:00' AS SmallDateTime), CAST(N'2016-12-07 10:22:29.407' AS DateTime), 19, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1140, N'1395', N'علی محمدی', NULL, 0, CAST(N'2016-12-07 10:22:00' AS SmallDateTime), CAST(N'2016-12-07 10:22:32.923' AS DateTime), 18, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1141, N'1395', N'علی محمدی', NULL, 0, CAST(N'2016-12-07 10:22:00' AS SmallDateTime), CAST(N'2016-12-07 10:22:38.940' AS DateTime), 18, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1142, N'1395', N'علی محمدی', NULL, 0, CAST(N'2016-12-07 10:22:00' AS SmallDateTime), CAST(N'2016-12-07 10:22:54.830' AS DateTime), 18, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1143, N'1395', N'علی محمدی', NULL, 0, CAST(N'2016-12-07 10:23:00' AS SmallDateTime), CAST(N'2016-12-07 10:23:11.580' AS DateTime), 18, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1144, N'1395', N'علی محمدی', NULL, 1, CAST(N'2016-12-07 10:23:00' AS SmallDateTime), CAST(N'2016-12-07 10:23:21.817' AS DateTime), 19, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1145, N'1395', N'علی محمدی', NULL, 0, CAST(N'2016-12-07 10:23:00' AS SmallDateTime), CAST(N'2016-12-07 10:23:57.300' AS DateTime), 18, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1146, N'1395', N'علی محمدی', NULL, 0, CAST(N'2016-12-07 10:24:00' AS SmallDateTime), CAST(N'2016-12-07 10:24:13.923' AS DateTime), 18, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1147, N'1395', N'علی محمدی', NULL, 0, CAST(N'2016-12-07 10:24:00' AS SmallDateTime), CAST(N'2016-12-07 10:24:20.520' AS DateTime), 18, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1148, N'1395', N'علی محمدی', NULL, 0, CAST(N'2016-12-07 10:25:00' AS SmallDateTime), CAST(N'2016-12-07 10:25:03.267' AS DateTime), 18, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1149, N'1395', N'علی محمدی', NULL, 0, CAST(N'2016-12-07 10:25:00' AS SmallDateTime), CAST(N'2016-12-07 10:25:45.830' AS DateTime), 2, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1150, N'1395', N'علی محمدی', NULL, 1, CAST(N'2016-12-07 10:25:00' AS SmallDateTime), CAST(N'2016-12-07 10:25:51.390' AS DateTime), 19, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1151, N'1395', N'علی محمدی', NULL, 1, CAST(N'2016-12-07 10:25:00' AS SmallDateTime), CAST(N'2016-12-07 10:25:59.580' AS DateTime), 19, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1152, N'1314', N'فاطمه داوودی', NULL, 1, CAST(N'2016-12-07 10:29:00' AS SmallDateTime), CAST(N'2016-12-07 10:29:50.687' AS DateTime), 5, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1153, N'1314', N'فاطمه داوودی', NULL, 1, CAST(N'2016-12-07 10:35:00' AS SmallDateTime), CAST(N'2016-12-07 10:35:19.173' AS DateTime), 9, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1154, N'1395', N'علی محمدی', NULL, 1, CAST(N'2016-12-07 10:35:00' AS SmallDateTime), CAST(N'2016-12-07 10:35:21.483' AS DateTime), 9, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1155, N'1395', N'علی محمدی', NULL, 0, CAST(N'2016-12-07 10:35:00' AS SmallDateTime), CAST(N'2016-12-07 10:35:25.687' AS DateTime), 8, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1156, N'1395', N'علی محمدی', NULL, 1, CAST(N'2016-12-07 10:35:00' AS SmallDateTime), CAST(N'2016-12-07 10:35:30.483' AS DateTime), 7, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1157, N'1395', N'علی محمدی', NULL, 0, CAST(N'2016-12-07 10:35:00' AS SmallDateTime), CAST(N'2016-12-07 10:35:33.627' AS DateTime), 6, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1158, N'1314', N'فاطمه داوودی', NULL, 1, CAST(N'2016-12-07 10:35:00' AS SmallDateTime), CAST(N'2016-12-07 10:35:39.610' AS DateTime), 7, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1159, N'1395', N'علی محمدی', NULL, 1, CAST(N'2016-12-07 10:35:00' AS SmallDateTime), CAST(N'2016-12-07 10:35:39.907' AS DateTime), 9, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1160, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 10:35:00' AS SmallDateTime), CAST(N'2016-12-07 10:35:44.250' AS DateTime), 7, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1161, N'1395', N'علی محمدی', NULL, 1, CAST(N'2016-12-07 10:35:00' AS SmallDateTime), CAST(N'2016-12-07 10:35:46.640' AS DateTime), 9, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1162, N'1316', N'محمد ندایی', NULL, 0, CAST(N'2016-12-07 10:35:00' AS SmallDateTime), CAST(N'2016-12-07 10:35:52.627' AS DateTime), 8, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1163, N'1314', N'فاطمه داوودی', NULL, 0, CAST(N'2016-12-07 10:35:00' AS SmallDateTime), CAST(N'2016-12-07 10:35:53.627' AS DateTime), 6, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1164, N'1314', N'فاطمه داوودی', NULL, 1, CAST(N'2016-12-07 10:36:00' AS SmallDateTime), CAST(N'2016-12-07 10:36:10.237' AS DateTime), 7, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1165, N'1314', N'فاطمه داوودی', NULL, 1, CAST(N'2016-12-07 10:36:00' AS SmallDateTime), CAST(N'2016-12-07 10:36:12.813' AS DateTime), 9, NULL, 15)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1166, N'1314', N'فاطمه داوودی', NULL, 0, CAST(N'2016-12-07 10:36:00' AS SmallDateTime), CAST(N'2016-12-07 10:36:16.220' AS DateTime), 8, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1167, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 10:36:00' AS SmallDateTime), CAST(N'2016-12-07 10:36:26.127' AS DateTime), 7, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1168, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 10:38:00' AS SmallDateTime), CAST(N'2016-12-07 10:38:06.207' AS DateTime), 11, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1169, N'1314', N'فاطمه داوودی', NULL, 1, CAST(N'2016-12-07 10:38:00' AS SmallDateTime), CAST(N'2016-12-07 10:38:06.940' AS DateTime), 13, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1170, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 10:38:00' AS SmallDateTime), CAST(N'2016-12-07 10:38:09.847' AS DateTime), 11, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1171, N'1314', N'فاطمه داوودی', NULL, 1, CAST(N'2016-12-07 10:38:00' AS SmallDateTime), CAST(N'2016-12-07 10:38:13.300' AS DateTime), 13, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1172, N'1316', N'محمد ندایی', NULL, 0, CAST(N'2016-12-07 10:38:00' AS SmallDateTime), CAST(N'2016-12-07 10:38:16.833' AS DateTime), 10, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1173, N'1314', N'فاطمه داوودی', NULL, 1, CAST(N'2016-12-07 10:38:00' AS SmallDateTime), CAST(N'2016-12-07 10:38:36.597' AS DateTime), 5, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1174, N'1314', N'فاطمه داوودی', NULL, 1, CAST(N'2016-12-07 10:38:00' AS SmallDateTime), CAST(N'2016-12-07 10:38:39.347' AS DateTime), 5, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1175, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 10:38:00' AS SmallDateTime), CAST(N'2016-12-07 10:38:41.957' AS DateTime), 5, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1176, N'1316', N'محمد ندایی', NULL, 0, CAST(N'2016-12-07 10:38:00' AS SmallDateTime), CAST(N'2016-12-07 10:38:45.380' AS DateTime), 2, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1177, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 10:38:00' AS SmallDateTime), CAST(N'2016-12-07 10:38:49.097' AS DateTime), 5, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1178, N'1314', N'فاطمه داوودی', NULL, 0, CAST(N'2016-12-07 10:38:00' AS SmallDateTime), CAST(N'2016-12-07 10:38:55.880' AS DateTime), 2, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1179, N'1314', N'فاطمه داوودی', NULL, 1, CAST(N'2016-12-07 10:38:00' AS SmallDateTime), CAST(N'2016-12-07 10:38:59.943' AS DateTime), 5, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1180, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 10:39:00' AS SmallDateTime), CAST(N'2016-12-07 10:39:09.083' AS DateTime), 5, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1181, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 10:39:00' AS SmallDateTime), CAST(N'2016-12-07 10:39:10.957' AS DateTime), 5, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1182, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 10:39:00' AS SmallDateTime), CAST(N'2016-12-07 10:39:22.267' AS DateTime), 5, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1183, N'1314', N'فاطمه داوودی', NULL, 1, CAST(N'2016-12-07 10:39:00' AS SmallDateTime), CAST(N'2016-12-07 10:39:25.877' AS DateTime), 7, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1184, N'1314', N'فاطمه داوودی', NULL, 1, CAST(N'2016-12-07 10:39:00' AS SmallDateTime), CAST(N'2016-12-07 10:39:27.860' AS DateTime), 9, NULL, 15)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1185, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 10:39:00' AS SmallDateTime), CAST(N'2016-12-07 10:39:34.987' AS DateTime), 7, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1186, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 10:39:00' AS SmallDateTime), CAST(N'2016-12-07 10:39:36.703' AS DateTime), 9, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1187, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 10:39:00' AS SmallDateTime), CAST(N'2016-12-07 10:39:40.267' AS DateTime), 5, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1188, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 10:39:00' AS SmallDateTime), CAST(N'2016-12-07 10:39:48.483' AS DateTime), 9, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1189, N'1314', N'فاطمه داوودی', NULL, 1, CAST(N'2016-12-07 10:39:00' AS SmallDateTime), CAST(N'2016-12-07 10:39:50.500' AS DateTime), 9, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1190, N'1314', N'فاطمه داوودی', NULL, 0, CAST(N'2016-12-07 10:39:00' AS SmallDateTime), CAST(N'2016-12-07 10:39:54.233' AS DateTime), 8, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1191, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 10:40:00' AS SmallDateTime), CAST(N'2016-12-07 10:40:18.517' AS DateTime), 5, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1192, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 10:40:00' AS SmallDateTime), CAST(N'2016-12-07 10:40:24.360' AS DateTime), 5, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1193, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 10:40:00' AS SmallDateTime), CAST(N'2016-12-07 10:40:29.860' AS DateTime), 5, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1194, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 10:40:00' AS SmallDateTime), CAST(N'2016-12-07 10:40:35.390' AS DateTime), 5, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1195, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 10:40:00' AS SmallDateTime), CAST(N'2016-12-07 10:40:43.280' AS DateTime), 5, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1196, N'1314', N'فاطمه داوودی', NULL, 1, CAST(N'2016-12-07 10:40:00' AS SmallDateTime), CAST(N'2016-12-07 10:40:49.360' AS DateTime), 5, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1197, N'1314', N'فاطمه داوودی', NULL, 1, CAST(N'2016-12-07 10:41:00' AS SmallDateTime), CAST(N'2016-12-07 10:41:07.877' AS DateTime), 5, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1198, N'1314', N'فاطمه داوودی', NULL, 0, CAST(N'2016-12-07 10:41:00' AS SmallDateTime), CAST(N'2016-12-07 10:41:19.033' AS DateTime), 2, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1199, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 10:41:00' AS SmallDateTime), CAST(N'2016-12-07 10:41:27.360' AS DateTime), 5, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1200, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 10:43:00' AS SmallDateTime), CAST(N'2016-12-07 10:43:17.470' AS DateTime), 5, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1201, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 10:43:00' AS SmallDateTime), CAST(N'2016-12-07 10:43:22.017' AS DateTime), 5, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1202, N'1395', N'علی محمدی', NULL, 1, CAST(N'2016-12-07 10:44:00' AS SmallDateTime), CAST(N'2016-12-07 10:44:10.800' AS DateTime), 5, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1203, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 10:45:00' AS SmallDateTime), CAST(N'2016-12-07 10:45:25.860' AS DateTime), 5, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1204, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 10:45:00' AS SmallDateTime), CAST(N'2016-12-07 10:45:32.097' AS DateTime), 5, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1205, N'1314', N'فاطمه داوودی', NULL, 1, CAST(N'2016-12-07 10:45:00' AS SmallDateTime), CAST(N'2016-12-07 10:45:35.720' AS DateTime), 5, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1206, N'1395', N'علی محمدی', NULL, 1, CAST(N'2016-12-07 10:45:00' AS SmallDateTime), CAST(N'2016-12-07 10:45:49.440' AS DateTime), 5, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1207, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 10:46:00' AS SmallDateTime), CAST(N'2016-12-07 10:46:09.173' AS DateTime), 5, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1208, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 10:46:00' AS SmallDateTime), CAST(N'2016-12-07 10:46:37.330' AS DateTime), 5, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1209, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 10:46:00' AS SmallDateTime), CAST(N'2016-12-07 10:46:40.533' AS DateTime), 5, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1210, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 10:46:00' AS SmallDateTime), CAST(N'2016-12-07 10:46:49.080' AS DateTime), 5, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1211, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 10:46:00' AS SmallDateTime), CAST(N'2016-12-07 10:46:50.970' AS DateTime), 5, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1212, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 10:51:00' AS SmallDateTime), CAST(N'2016-12-07 10:51:08.833' AS DateTime), 5, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1213, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 10:51:00' AS SmallDateTime), CAST(N'2016-12-07 10:51:11.443' AS DateTime), 5, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1214, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 10:52:00' AS SmallDateTime), CAST(N'2016-12-07 10:52:15.943' AS DateTime), 7, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1215, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 10:54:00' AS SmallDateTime), CAST(N'2016-12-07 10:54:58.383' AS DateTime), 5, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1216, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 10:55:00' AS SmallDateTime), CAST(N'2016-12-07 10:55:01.413' AS DateTime), 5, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1217, N'1314', N'فاطمه داوودی', NULL, 1, CAST(N'2016-12-07 10:55:00' AS SmallDateTime), CAST(N'2016-12-07 10:55:13.757' AS DateTime), 5, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1218, N'1395', N'علی محمدی', NULL, 1, CAST(N'2016-12-07 10:56:00' AS SmallDateTime), CAST(N'2016-12-07 10:56:12.633' AS DateTime), 5, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1219, N'1395', N'علی محمدی', NULL, 1, CAST(N'2016-12-07 10:56:00' AS SmallDateTime), CAST(N'2016-12-07 10:56:16.103' AS DateTime), 5, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1220, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 10:57:00' AS SmallDateTime), CAST(N'2016-12-07 10:57:58.157' AS DateTime), 7, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1221, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 10:58:00' AS SmallDateTime), CAST(N'2016-12-07 10:58:03.453' AS DateTime), 9, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1222, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 10:58:00' AS SmallDateTime), CAST(N'2016-12-07 10:58:07.173' AS DateTime), 5, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1223, N'1395', N'علی محمدی', NULL, 1, CAST(N'2016-12-07 10:58:00' AS SmallDateTime), CAST(N'2016-12-07 10:58:12.547' AS DateTime), 5, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1224, N'1395', N'علی محمدی', NULL, 1, CAST(N'2016-12-07 10:58:00' AS SmallDateTime), CAST(N'2016-12-07 10:58:18.643' AS DateTime), 5, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1225, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 10:58:00' AS SmallDateTime), CAST(N'2016-12-07 10:58:27.627' AS DateTime), 7, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1226, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 10:58:00' AS SmallDateTime), CAST(N'2016-12-07 10:58:31.847' AS DateTime), 5, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1227, N'1314', N'فاطمه داوودی', NULL, 1, CAST(N'2016-12-07 10:58:00' AS SmallDateTime), CAST(N'2016-12-07 10:58:51.877' AS DateTime), 5, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1228, N'1314', N'فاطمه داوودی', NULL, 1, CAST(N'2016-12-07 10:59:00' AS SmallDateTime), CAST(N'2016-12-07 10:59:27.907' AS DateTime), 5, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1229, N'0', N' ', NULL, 1, CAST(N'2016-12-07 11:04:00' AS SmallDateTime), CAST(N'2016-12-07 11:04:44.620' AS DateTime), 11, NULL, 11)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1230, N'0', N' ', NULL, 1, CAST(N'2016-12-07 11:05:00' AS SmallDateTime), CAST(N'2016-12-07 11:05:19.877' AS DateTime), 11, NULL, 11)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1231, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 11:05:00' AS SmallDateTime), CAST(N'2016-12-07 11:05:50.800' AS DateTime), 5, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1232, N'1314', N'فاطمه داوودی', NULL, 1, CAST(N'2016-12-07 11:05:00' AS SmallDateTime), CAST(N'2016-12-07 11:05:58.223' AS DateTime), 5, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1233, N'1314', N'فاطمه داوودی', NULL, 1, CAST(N'2016-12-07 11:06:00' AS SmallDateTime), CAST(N'2016-12-07 11:06:03.317' AS DateTime), 5, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1234, N'1314', N'فاطمه داوودی', NULL, 1, CAST(N'2016-12-07 11:06:00' AS SmallDateTime), CAST(N'2016-12-07 11:06:07.097' AS DateTime), 5, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1235, N'1314', N'فاطمه داوودی', NULL, 1, CAST(N'2016-12-07 11:06:00' AS SmallDateTime), CAST(N'2016-12-07 11:06:13.347' AS DateTime), 5, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1236, N'1395', N'علی محمدی', NULL, 1, CAST(N'2016-12-07 11:06:00' AS SmallDateTime), CAST(N'2016-12-07 11:06:16.533' AS DateTime), 5, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1237, N'1314', N'فاطمه داوودی', NULL, 1, CAST(N'2016-12-07 11:06:00' AS SmallDateTime), CAST(N'2016-12-07 11:06:22.363' AS DateTime), 9, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1238, N'1314', N'فاطمه داوودی', NULL, 0, CAST(N'2016-12-07 11:06:00' AS SmallDateTime), CAST(N'2016-12-07 11:06:25.833' AS DateTime), 2, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1239, N'1314', N'فاطمه داوودی', NULL, 0, CAST(N'2016-12-07 11:06:00' AS SmallDateTime), CAST(N'2016-12-07 11:06:39.550' AS DateTime), 2, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1240, N'1314', N'فاطمه داوودی', NULL, 1, CAST(N'2016-12-07 11:06:00' AS SmallDateTime), CAST(N'2016-12-07 11:06:57.037' AS DateTime), 5, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1241, N'1314', N'فاطمه داوودی', NULL, 0, CAST(N'2016-12-07 11:07:00' AS SmallDateTime), CAST(N'2016-12-07 11:07:01.300' AS DateTime), 2, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1242, N'1314', N'فاطمه داوودی', NULL, 0, CAST(N'2016-12-07 11:07:00' AS SmallDateTime), CAST(N'2016-12-07 11:07:07.317' AS DateTime), 2, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1243, N'1314', N'فاطمه داوودی', NULL, 0, CAST(N'2016-12-07 11:07:00' AS SmallDateTime), CAST(N'2016-12-07 11:07:11.817' AS DateTime), 2, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1244, N'1314', N'فاطمه داوودی', NULL, 0, CAST(N'2016-12-07 11:07:00' AS SmallDateTime), CAST(N'2016-12-07 11:07:17.490' AS DateTime), 6, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1245, N'1314', N'فاطمه داوودی', NULL, 0, CAST(N'2016-12-07 11:07:00' AS SmallDateTime), CAST(N'2016-12-07 11:07:19.660' AS DateTime), 8, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1246, N'1314', N'فاطمه داوودی', NULL, 1, CAST(N'2016-12-07 11:07:00' AS SmallDateTime), CAST(N'2016-12-07 11:07:22.753' AS DateTime), 9, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1247, N'1314', N'فاطمه داوودی', NULL, 0, CAST(N'2016-12-07 11:07:00' AS SmallDateTime), CAST(N'2016-12-07 11:07:27.067' AS DateTime), 2, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1248, N'1314', N'فاطمه داوودی', NULL, 0, CAST(N'2016-12-07 11:07:00' AS SmallDateTime), CAST(N'2016-12-07 11:07:32.800' AS DateTime), 2, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1249, N'1314', N'فاطمه داوودی', NULL, 0, CAST(N'2016-12-07 11:07:00' AS SmallDateTime), CAST(N'2016-12-07 11:07:37.287' AS DateTime), 2, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1250, N'1314', N'فاطمه داوودی', NULL, 0, CAST(N'2016-12-07 11:07:00' AS SmallDateTime), CAST(N'2016-12-07 11:07:39.897' AS DateTime), 2, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1251, N'1314', N'فاطمه داوودی', NULL, 0, CAST(N'2016-12-07 11:07:00' AS SmallDateTime), CAST(N'2016-12-07 11:07:41.770' AS DateTime), 2, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1252, N'1314', N'فاطمه داوودی', NULL, 0, CAST(N'2016-12-07 11:08:00' AS SmallDateTime), CAST(N'2016-12-07 11:08:09.177' AS DateTime), 6, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1253, N'1314', N'فاطمه داوودی', NULL, 0, CAST(N'2016-12-07 11:08:00' AS SmallDateTime), CAST(N'2016-12-07 11:08:11.787' AS DateTime), 8, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1254, N'1314', N'فاطمه داوودی', NULL, 0, CAST(N'2016-12-07 11:08:00' AS SmallDateTime), CAST(N'2016-12-07 11:08:14.100' AS DateTime), 6, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1255, N'1314', N'فاطمه داوودی', NULL, 0, CAST(N'2016-12-07 11:08:00' AS SmallDateTime), CAST(N'2016-12-07 11:08:16.910' AS DateTime), 2, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1256, N'1314', N'فاطمه داوودی', NULL, 0, CAST(N'2016-12-07 11:08:00' AS SmallDateTime), CAST(N'2016-12-07 11:08:19.160' AS DateTime), 18, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1257, N'1314', N'فاطمه داوودی', NULL, 0, CAST(N'2016-12-07 11:08:00' AS SmallDateTime), CAST(N'2016-12-07 11:08:22.787' AS DateTime), 18, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1258, N'1314', N'فاطمه داوودی', NULL, 0, CAST(N'2016-12-07 11:08:00' AS SmallDateTime), CAST(N'2016-12-07 11:08:35.583' AS DateTime), 6, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1259, N'1314', N'فاطمه داوودی', NULL, 1, CAST(N'2016-12-07 11:08:00' AS SmallDateTime), CAST(N'2016-12-07 11:08:50.083' AS DateTime), 9, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1260, N'1314', N'فاطمه داوودی', NULL, 1, CAST(N'2016-12-07 11:08:00' AS SmallDateTime), CAST(N'2016-12-07 11:08:52.600' AS DateTime), 7, NULL, 15)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1261, N'1314', N'فاطمه داوودی', NULL, 1, CAST(N'2016-12-07 11:08:00' AS SmallDateTime), CAST(N'2016-12-07 11:08:54.240' AS DateTime), 5, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1262, N'1314', N'فاطمه داوودی', NULL, 1, CAST(N'2016-12-07 11:09:00' AS SmallDateTime), CAST(N'2016-12-07 11:09:01.880' AS DateTime), 5, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1263, N'1314', N'فاطمه داوودی', NULL, 1, CAST(N'2016-12-07 11:09:00' AS SmallDateTime), CAST(N'2016-12-07 11:09:07.113' AS DateTime), 5, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1264, N'1314', N'فاطمه داوودی', NULL, 1, CAST(N'2016-12-07 11:09:00' AS SmallDateTime), CAST(N'2016-12-07 11:09:11.053' AS DateTime), 5, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1265, N'1314', N'فاطمه داوودی', NULL, 1, CAST(N'2016-12-07 11:09:00' AS SmallDateTime), CAST(N'2016-12-07 11:09:17.583' AS DateTime), 5, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1266, N'1314', N'فاطمه داوودی', NULL, 1, CAST(N'2016-12-07 11:09:00' AS SmallDateTime), CAST(N'2016-12-07 11:09:22.363' AS DateTime), 7, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1267, N'1314', N'فاطمه داوودی', NULL, 1, CAST(N'2016-12-07 11:09:00' AS SmallDateTime), CAST(N'2016-12-07 11:09:30.350' AS DateTime), 5, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1268, N'1314', N'فاطمه داوودی', NULL, 1, CAST(N'2016-12-07 11:10:00' AS SmallDateTime), CAST(N'2016-12-07 11:10:44.533' AS DateTime), 7, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1269, N'1314', N'فاطمه داوودی', NULL, 1, CAST(N'2016-12-07 11:10:00' AS SmallDateTime), CAST(N'2016-12-07 11:10:47.440' AS DateTime), 7, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1270, N'1314', N'فاطمه داوودی', NULL, 1, CAST(N'2016-12-07 11:10:00' AS SmallDateTime), CAST(N'2016-12-07 11:10:52.377' AS DateTime), 5, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1271, N'1314', N'فاطمه داوودی', NULL, 1, CAST(N'2016-12-07 11:10:00' AS SmallDateTime), CAST(N'2016-12-07 11:10:54.830' AS DateTime), 7, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1272, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 11:12:00' AS SmallDateTime), CAST(N'2016-12-07 11:12:32.830' AS DateTime), 7, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1273, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 11:12:00' AS SmallDateTime), CAST(N'2016-12-07 11:12:36.020' AS DateTime), 7, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1274, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 11:12:00' AS SmallDateTime), CAST(N'2016-12-07 11:12:39.783' AS DateTime), 7, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1275, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 11:12:00' AS SmallDateTime), CAST(N'2016-12-07 11:12:48.533' AS DateTime), 5, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1276, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 11:12:00' AS SmallDateTime), CAST(N'2016-12-07 11:12:51.080' AS DateTime), 5, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1277, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 11:12:00' AS SmallDateTime), CAST(N'2016-12-07 11:12:57.317' AS DateTime), 5, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1278, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 11:13:00' AS SmallDateTime), CAST(N'2016-12-07 11:13:01.380' AS DateTime), 5, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1279, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 11:13:00' AS SmallDateTime), CAST(N'2016-12-07 11:13:06.020' AS DateTime), 5, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1280, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 11:13:00' AS SmallDateTime), CAST(N'2016-12-07 11:13:10.237' AS DateTime), 5, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1281, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 11:13:00' AS SmallDateTime), CAST(N'2016-12-07 11:13:18.503' AS DateTime), 5, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1282, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 11:13:00' AS SmallDateTime), CAST(N'2016-12-07 11:13:59.207' AS DateTime), 7, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1283, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 11:14:00' AS SmallDateTime), CAST(N'2016-12-07 11:14:02.537' AS DateTime), 7, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1284, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 11:14:00' AS SmallDateTime), CAST(N'2016-12-07 11:14:06.300' AS DateTime), 7, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1285, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 11:14:00' AS SmallDateTime), CAST(N'2016-12-07 11:14:27.067' AS DateTime), 7, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1286, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 11:14:00' AS SmallDateTime), CAST(N'2016-12-07 11:14:30.550' AS DateTime), 7, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1287, N'1316', N'محمد ندایی', NULL, 0, CAST(N'2016-12-07 11:14:00' AS SmallDateTime), CAST(N'2016-12-07 11:14:45.927' AS DateTime), 2, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1288, N'1316', N'محمد ندایی', NULL, 0, CAST(N'2016-12-07 11:14:00' AS SmallDateTime), CAST(N'2016-12-07 11:14:54.973' AS DateTime), 2, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1289, N'1316', N'محمد ندایی', NULL, 0, CAST(N'2016-12-07 11:15:00' AS SmallDateTime), CAST(N'2016-12-07 11:15:00.347' AS DateTime), 2, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1290, N'1316', N'محمد ندایی', NULL, 0, CAST(N'2016-12-07 11:15:00' AS SmallDateTime), CAST(N'2016-12-07 11:15:07.003' AS DateTime), 2, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1291, N'1316', N'محمد ندایی', NULL, 0, CAST(N'2016-12-07 11:15:00' AS SmallDateTime), CAST(N'2016-12-07 11:15:41.743' AS DateTime), 6, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1292, N'1316', N'محمد ندایی', NULL, 0, CAST(N'2016-12-07 11:15:00' AS SmallDateTime), CAST(N'2016-12-07 11:15:46.103' AS DateTime), 6, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1293, N'1316', N'محمد ندایی', NULL, 0, CAST(N'2016-12-07 11:15:00' AS SmallDateTime), CAST(N'2016-12-07 11:15:54.370' AS DateTime), 6, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1294, N'1316', N'محمد ندایی', NULL, 0, CAST(N'2016-12-07 11:16:00' AS SmallDateTime), CAST(N'2016-12-07 11:16:00.870' AS DateTime), 2, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1295, N'1316', N'محمد ندایی', NULL, 0, CAST(N'2016-12-07 11:17:00' AS SmallDateTime), CAST(N'2016-12-07 11:17:02.307' AS DateTime), 6, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1296, N'1316', N'محمد ندایی', NULL, 0, CAST(N'2016-12-07 11:17:00' AS SmallDateTime), CAST(N'2016-12-07 11:17:16.243' AS DateTime), 6, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1297, N'1316', N'محمد ندایی', NULL, 0, CAST(N'2016-12-07 11:17:00' AS SmallDateTime), CAST(N'2016-12-07 11:17:32.213' AS DateTime), 6, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1298, N'1316', N'محمد ندایی', NULL, 0, CAST(N'2016-12-07 11:17:00' AS SmallDateTime), CAST(N'2016-12-07 11:17:43.527' AS DateTime), 2, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1299, N'1316', N'محمد ندایی', NULL, 0, CAST(N'2016-12-07 11:17:00' AS SmallDateTime), CAST(N'2016-12-07 11:17:47.590' AS DateTime), 2, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1300, N'1316', N'محمد ندایی', NULL, 0, CAST(N'2016-12-07 11:17:00' AS SmallDateTime), CAST(N'2016-12-07 11:17:58.917' AS DateTime), 6, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1301, N'1316', N'محمد ندایی', NULL, 0, CAST(N'2016-12-07 11:18:00' AS SmallDateTime), CAST(N'2016-12-07 11:18:06.167' AS DateTime), 2, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1302, N'1316', N'محمد ندایی', NULL, 0, CAST(N'2016-12-07 11:18:00' AS SmallDateTime), CAST(N'2016-12-07 11:18:17.197' AS DateTime), 2, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1303, N'1316', N'محمد ندایی', NULL, 0, CAST(N'2016-12-07 11:18:00' AS SmallDateTime), CAST(N'2016-12-07 11:18:23.293' AS DateTime), 2, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1304, N'1316', N'محمد ندایی', NULL, 0, CAST(N'2016-12-07 11:18:00' AS SmallDateTime), CAST(N'2016-12-07 11:18:31.400' AS DateTime), 2, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1305, N'1316', N'محمد ندایی', NULL, 0, CAST(N'2016-12-07 11:19:00' AS SmallDateTime), CAST(N'2016-12-07 11:19:08.010' AS DateTime), 18, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1306, N'1316', N'محمد ندایی', NULL, 0, CAST(N'2016-12-07 11:19:00' AS SmallDateTime), CAST(N'2016-12-07 11:19:11.057' AS DateTime), 18, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1307, N'0', N' ', NULL, 1, CAST(N'2016-12-07 11:21:00' AS SmallDateTime), CAST(N'2016-12-07 11:21:22.427' AS DateTime), 11, NULL, 11)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1308, N'1316', N'محمد ندایی', NULL, 0, CAST(N'2016-12-07 11:22:00' AS SmallDateTime), CAST(N'2016-12-07 11:22:12.113' AS DateTime), 6, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1309, N'1316', N'محمد ندایی', NULL, 0, CAST(N'2016-12-07 11:22:00' AS SmallDateTime), CAST(N'2016-12-07 11:22:16.300' AS DateTime), 6, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1310, N'1316', N'محمد ندایی', NULL, 0, CAST(N'2016-12-07 11:22:00' AS SmallDateTime), CAST(N'2016-12-07 11:22:20.643' AS DateTime), 6, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1311, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 11:22:00' AS SmallDateTime), CAST(N'2016-12-07 11:22:25.723' AS DateTime), 7, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1312, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 11:22:00' AS SmallDateTime), CAST(N'2016-12-07 11:22:30.893' AS DateTime), 7, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1313, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 11:22:00' AS SmallDateTime), CAST(N'2016-12-07 11:22:34.363' AS DateTime), 7, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1314, N'1316', N'محمد ندایی', NULL, 0, CAST(N'2016-12-07 11:22:00' AS SmallDateTime), CAST(N'2016-12-07 11:22:41.440' AS DateTime), 2, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1315, N'1316', N'محمد ندایی', NULL, 0, CAST(N'2016-12-07 11:22:00' AS SmallDateTime), CAST(N'2016-12-07 11:22:48.003' AS DateTime), 2, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1316, N'1316', N'محمد ندایی', NULL, 0, CAST(N'2016-12-07 11:22:00' AS SmallDateTime), CAST(N'2016-12-07 11:22:56.550' AS DateTime), 2, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1317, N'1316', N'محمد ندایی', NULL, 0, CAST(N'2016-12-07 11:23:00' AS SmallDateTime), CAST(N'2016-12-07 11:23:04.833' AS DateTime), 2, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1318, N'1316', N'محمد ندایی', NULL, 0, CAST(N'2016-12-07 11:23:00' AS SmallDateTime), CAST(N'2016-12-07 11:23:18.473' AS DateTime), 2, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1319, N'1316', N'محمد ندایی', NULL, 0, CAST(N'2016-12-07 11:23:00' AS SmallDateTime), CAST(N'2016-12-07 11:23:27.660' AS DateTime), 6, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1320, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 11:24:00' AS SmallDateTime), CAST(N'2016-12-07 11:24:00.443' AS DateTime), 5, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1321, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 11:24:00' AS SmallDateTime), CAST(N'2016-12-07 11:24:05.803' AS DateTime), 5, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1322, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 11:24:00' AS SmallDateTime), CAST(N'2016-12-07 11:24:21.630' AS DateTime), 5, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1323, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 11:24:00' AS SmallDateTime), CAST(N'2016-12-07 11:24:25.380' AS DateTime), 5, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1324, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 11:26:00' AS SmallDateTime), CAST(N'2016-12-07 11:26:12.693' AS DateTime), 5, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1325, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 11:26:00' AS SmallDateTime), CAST(N'2016-12-07 11:26:17.473' AS DateTime), 5, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1326, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 11:26:00' AS SmallDateTime), CAST(N'2016-12-07 11:26:25.397' AS DateTime), 7, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1327, N'1316', N'محمد ندایی', NULL, 1, CAST(N'2016-12-07 11:26:00' AS SmallDateTime), CAST(N'2016-12-07 11:26:33.583' AS DateTime), 5, NULL, 3)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1328, N'1316', N'محمد ندایی', NULL, 0, CAST(N'2016-12-07 11:28:00' AS SmallDateTime), CAST(N'2016-12-07 11:28:27.587' AS DateTime), 2, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1329, N'1395', N'علی محمدی', NULL, 1, CAST(N'2016-12-07 18:17:00' AS SmallDateTime), CAST(N'2016-12-07 18:17:10.707' AS DateTime), 5, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1330, N'1395', N'علی محمدی', NULL, 1, CAST(N'2016-12-07 18:17:00' AS SmallDateTime), CAST(N'2016-12-07 18:17:19.863' AS DateTime), 5, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1331, N'1395', N'علی محمدی', NULL, 1, CAST(N'2016-12-07 18:17:00' AS SmallDateTime), CAST(N'2016-12-07 18:17:24.877' AS DateTime), 5, NULL, 0)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1332, N'1395', N'علی محمدی', NULL, 1, CAST(N'2016-12-07 18:17:00' AS SmallDateTime), CAST(N'2016-12-07 18:17:29.847' AS DateTime), 5, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1333, N'1395', N'علی محمدی', NULL, 1, CAST(N'2016-12-07 18:18:00' AS SmallDateTime), CAST(N'2016-12-07 18:18:54.470' AS DateTime), 5, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1334, N'1395', N'علی محمدی', NULL, 1, CAST(N'2016-12-07 18:19:00' AS SmallDateTime), CAST(N'2016-12-07 18:19:16.890' AS DateTime), 5, NULL, 1)
GO
INSERT [dbo].[gitlog] ([id], [stu_id], [nam], [pic], [direction], [tim], [dat], [deviceId], [typepass], [commentId]) VALUES (1335, N'1314', N'فاطمه داوودی', NULL, 0, CAST(N'2016-12-08 12:34:00' AS SmallDateTime), CAST(N'2016-12-08 12:34:04.007' AS DateTime), 7, NULL, 13)
GO
SET IDENTITY_INSERT [dbo].[gitlog] OFF
GO
SET IDENTITY_INSERT [dbo].[gitlogOperator] ON 

GO
INSERT [dbo].[gitlogOperator] ([id], [ip], [us], [tim], [dat], [msgopId], [descript]) VALUES (102, N'169.254.63.189', N'admin', NULL, CAST(N'2016-12-06 16:55:09.010' AS DateTime), 1, NULL)
GO
INSERT [dbo].[gitlogOperator] ([id], [ip], [us], [tim], [dat], [msgopId], [descript]) VALUES (103, N'169.254.63.189', N'admin', NULL, CAST(N'2016-12-06 16:57:24.740' AS DateTime), 1, NULL)
GO
INSERT [dbo].[gitlogOperator] ([id], [ip], [us], [tim], [dat], [msgopId], [descript]) VALUES (104, N'169.254.63.189', N'admin', NULL, CAST(N'2016-12-06 16:59:35.863' AS DateTime), 1, NULL)
GO
INSERT [dbo].[gitlogOperator] ([id], [ip], [us], [tim], [dat], [msgopId], [descript]) VALUES (105, N'169.254.63.189', N'admin', NULL, CAST(N'2016-12-06 17:01:00.420' AS DateTime), 1, NULL)
GO
INSERT [dbo].[gitlogOperator] ([id], [ip], [us], [tim], [dat], [msgopId], [descript]) VALUES (106, N'169.254.63.189', N'admin', NULL, CAST(N'2016-12-06 17:07:32.973' AS DateTime), 1, NULL)
GO
INSERT [dbo].[gitlogOperator] ([id], [ip], [us], [tim], [dat], [msgopId], [descript]) VALUES (107, N'169.254.63.189', N'admin', NULL, CAST(N'2016-12-06 17:15:56.217' AS DateTime), 1, NULL)
GO
INSERT [dbo].[gitlogOperator] ([id], [ip], [us], [tim], [dat], [msgopId], [descript]) VALUES (108, N'169.254.63.189', N'admin', NULL, CAST(N'2016-12-06 17:24:34.800' AS DateTime), 1, NULL)
GO
INSERT [dbo].[gitlogOperator] ([id], [ip], [us], [tim], [dat], [msgopId], [descript]) VALUES (109, N'169.254.63.189', N'admin', NULL, CAST(N'2016-12-06 17:25:32.843' AS DateTime), 1, NULL)
GO
INSERT [dbo].[gitlogOperator] ([id], [ip], [us], [tim], [dat], [msgopId], [descript]) VALUES (110, N'169.254.63.189', N'admin', NULL, CAST(N'2016-12-06 17:28:04.753' AS DateTime), 1, NULL)
GO
INSERT [dbo].[gitlogOperator] ([id], [ip], [us], [tim], [dat], [msgopId], [descript]) VALUES (111, N'127.0.0.1', N'admin', NULL, CAST(N'2016-12-08 08:43:05.047' AS DateTime), 1, NULL)
GO
INSERT [dbo].[gitlogOperator] ([id], [ip], [us], [tim], [dat], [msgopId], [descript]) VALUES (112, N'127.0.0.1', N'admin', NULL, CAST(N'2016-12-08 08:54:40.407' AS DateTime), 1, NULL)
GO
INSERT [dbo].[gitlogOperator] ([id], [ip], [us], [tim], [dat], [msgopId], [descript]) VALUES (113, N'127.0.0.1', N'admin', NULL, CAST(N'2016-12-08 08:59:22.467' AS DateTime), 2, NULL)
GO
INSERT [dbo].[gitlogOperator] ([id], [ip], [us], [tim], [dat], [msgopId], [descript]) VALUES (114, N'127.0.0.1', N'admin', NULL, CAST(N'2016-12-08 08:59:26.963' AS DateTime), 1, NULL)
GO
INSERT [dbo].[gitlogOperator] ([id], [ip], [us], [tim], [dat], [msgopId], [descript]) VALUES (115, N'10.8.33.49', N'admin', NULL, CAST(N'2016-12-08 09:24:27.943' AS DateTime), 1, NULL)
GO
INSERT [dbo].[gitlogOperator] ([id], [ip], [us], [tim], [dat], [msgopId], [descript]) VALUES (116, N'10.8.33.49', N'admin', NULL, CAST(N'2016-12-08 09:25:27.797' AS DateTime), 1, NULL)
GO
INSERT [dbo].[gitlogOperator] ([id], [ip], [us], [tim], [dat], [msgopId], [descript]) VALUES (117, N'10.8.33.49', N'admin', NULL, CAST(N'2016-12-08 09:37:08.707' AS DateTime), 1, NULL)
GO
INSERT [dbo].[gitlogOperator] ([id], [ip], [us], [tim], [dat], [msgopId], [descript]) VALUES (118, N'10.8.33.49', N'admin', NULL, CAST(N'2016-12-08 09:45:24.303' AS DateTime), 1, NULL)
GO
INSERT [dbo].[gitlogOperator] ([id], [ip], [us], [tim], [dat], [msgopId], [descript]) VALUES (119, N'10.8.33.49', N'admin', NULL, CAST(N'2016-12-08 09:47:25.103' AS DateTime), 1, NULL)
GO
INSERT [dbo].[gitlogOperator] ([id], [ip], [us], [tim], [dat], [msgopId], [descript]) VALUES (120, N'10.8.33.49', N'admin', NULL, CAST(N'2016-12-08 09:49:00.033' AS DateTime), 2, NULL)
GO
INSERT [dbo].[gitlogOperator] ([id], [ip], [us], [tim], [dat], [msgopId], [descript]) VALUES (121, N'10.8.33.49', N'admin', NULL, CAST(N'2016-12-08 09:49:03.877' AS DateTime), 1, NULL)
GO
INSERT [dbo].[gitlogOperator] ([id], [ip], [us], [tim], [dat], [msgopId], [descript]) VALUES (122, N'10.8.33.49', N'admin', NULL, CAST(N'2016-12-08 09:54:08.153' AS DateTime), 1, NULL)
GO
INSERT [dbo].[gitlogOperator] ([id], [ip], [us], [tim], [dat], [msgopId], [descript]) VALUES (123, N'10.8.33.49', N'admin', NULL, CAST(N'2016-12-08 10:07:43.220' AS DateTime), 1, NULL)
GO
INSERT [dbo].[gitlogOperator] ([id], [ip], [us], [tim], [dat], [msgopId], [descript]) VALUES (124, N'10.8.33.49', N'admin', NULL, CAST(N'2016-12-08 10:09:16.223' AS DateTime), 1, NULL)
GO
INSERT [dbo].[gitlogOperator] ([id], [ip], [us], [tim], [dat], [msgopId], [descript]) VALUES (125, N'10.8.33.49', N'admin', NULL, CAST(N'2016-12-08 10:11:15.687' AS DateTime), 1, NULL)
GO
INSERT [dbo].[gitlogOperator] ([id], [ip], [us], [tim], [dat], [msgopId], [descript]) VALUES (126, N'10.8.33.49', N'admin', NULL, CAST(N'2016-12-08 10:12:39.330' AS DateTime), 1, NULL)
GO
INSERT [dbo].[gitlogOperator] ([id], [ip], [us], [tim], [dat], [msgopId], [descript]) VALUES (127, N'10.8.33.49', N'admin', NULL, CAST(N'2016-12-08 10:17:48.890' AS DateTime), 1, NULL)
GO
INSERT [dbo].[gitlogOperator] ([id], [ip], [us], [tim], [dat], [msgopId], [descript]) VALUES (128, N'10.8.33.49', N'admin', NULL, CAST(N'2016-12-08 10:26:57.033' AS DateTime), 1, NULL)
GO
INSERT [dbo].[gitlogOperator] ([id], [ip], [us], [tim], [dat], [msgopId], [descript]) VALUES (129, N'10.8.33.49', N'admin', NULL, CAST(N'2016-12-08 10:29:46.053' AS DateTime), 1, NULL)
GO
INSERT [dbo].[gitlogOperator] ([id], [ip], [us], [tim], [dat], [msgopId], [descript]) VALUES (130, N'10.8.33.49', N'admin', NULL, CAST(N'2016-12-08 10:32:04.690' AS DateTime), 1, NULL)
GO
INSERT [dbo].[gitlogOperator] ([id], [ip], [us], [tim], [dat], [msgopId], [descript]) VALUES (131, N'10.8.33.49', N'admin', NULL, CAST(N'2016-12-08 11:34:42.790' AS DateTime), 1, NULL)
GO
INSERT [dbo].[gitlogOperator] ([id], [ip], [us], [tim], [dat], [msgopId], [descript]) VALUES (132, N'10.8.33.49', N'admin', NULL, CAST(N'2016-12-08 12:16:00.363' AS DateTime), 1, NULL)
GO
INSERT [dbo].[gitlogOperator] ([id], [ip], [us], [tim], [dat], [msgopId], [descript]) VALUES (133, N'10.8.33.49', N'admin', NULL, CAST(N'2016-12-08 12:16:05.247' AS DateTime), 6, NULL)
GO
INSERT [dbo].[gitlogOperator] ([id], [ip], [us], [tim], [dat], [msgopId], [descript]) VALUES (134, N'10.8.33.49', N'admin', NULL, CAST(N'2016-12-08 12:17:16.393' AS DateTime), 1, NULL)
GO
INSERT [dbo].[gitlogOperator] ([id], [ip], [us], [tim], [dat], [msgopId], [descript]) VALUES (135, N'10.8.33.49', N'admin', NULL, CAST(N'2016-12-08 12:17:19.567' AS DateTime), 6, NULL)
GO
INSERT [dbo].[gitlogOperator] ([id], [ip], [us], [tim], [dat], [msgopId], [descript]) VALUES (136, N'10.8.33.49', N'admin', NULL, CAST(N'2016-12-08 12:18:19.623' AS DateTime), 1, NULL)
GO
INSERT [dbo].[gitlogOperator] ([id], [ip], [us], [tim], [dat], [msgopId], [descript]) VALUES (137, N'10.8.33.49', N'admin', NULL, CAST(N'2016-12-08 12:18:23.103' AS DateTime), 6, NULL)
GO
INSERT [dbo].[gitlogOperator] ([id], [ip], [us], [tim], [dat], [msgopId], [descript]) VALUES (138, N'10.8.33.49', N'admin', NULL, CAST(N'2016-12-08 12:21:03.087' AS DateTime), 1, NULL)
GO
INSERT [dbo].[gitlogOperator] ([id], [ip], [us], [tim], [dat], [msgopId], [descript]) VALUES (139, N'10.8.33.49', N'admin', NULL, CAST(N'2016-12-08 12:21:06.313' AS DateTime), 6, NULL)
GO
INSERT [dbo].[gitlogOperator] ([id], [ip], [us], [tim], [dat], [msgopId], [descript]) VALUES (140, N'10.8.33.49', N'admin', NULL, CAST(N'2016-12-08 12:22:18.053' AS DateTime), 1, NULL)
GO
INSERT [dbo].[gitlogOperator] ([id], [ip], [us], [tim], [dat], [msgopId], [descript]) VALUES (141, N'10.8.33.49', N'admin', NULL, CAST(N'2016-12-08 12:33:42.353' AS DateTime), 1, NULL)
GO
INSERT [dbo].[gitlogOperator] ([id], [ip], [us], [tim], [dat], [msgopId], [descript]) VALUES (142, N'10.8.33.49', N'admin', NULL, CAST(N'2016-12-08 12:33:48.450' AS DateTime), 11, NULL)
GO
INSERT [dbo].[gitlogOperator] ([id], [ip], [us], [tim], [dat], [msgopId], [descript]) VALUES (143, N'10.8.33.49', N'admin', NULL, CAST(N'2016-12-08 12:33:55.360' AS DateTime), 6, NULL)
GO
INSERT [dbo].[gitlogOperator] ([id], [ip], [us], [tim], [dat], [msgopId], [descript]) VALUES (144, N'10.8.33.49', N'admin', NULL, CAST(N'2016-12-08 12:34:00.500' AS DateTime), 6, NULL)
GO
SET IDENTITY_INSERT [dbo].[gitlogOperator] OFF
GO
INSERT [dbo].[gitmessage] ([id], [message]) VALUES (0, N'تردد انجام شد')
GO
INSERT [dbo].[gitmessage] ([id], [message]) VALUES (1, N'تردد انجام نشد')
GO
INSERT [dbo].[gitmessage] ([id], [message]) VALUES (2, N'شخص مجوز تردد دارد.')
GO
INSERT [dbo].[gitmessage] ([id], [message]) VALUES (3, N'قبلا تردد داشته است.')
GO
INSERT [dbo].[gitmessage] ([id], [message]) VALUES (4, N'مجاز به تردد از این ناحیه نمی باشد.')
GO
INSERT [dbo].[gitmessage] ([id], [message]) VALUES (5, N'جنسیت مطابقت ندارد.')
GO
INSERT [dbo].[gitmessage] ([id], [message]) VALUES (6, N'دستگاه غیر فعال است.')
GO
INSERT [dbo].[gitmessage] ([id], [message]) VALUES (7, N'تردد کننده غیرفعال است.')
GO
INSERT [dbo].[gitmessage] ([id], [message]) VALUES (8, N'تاریخ اعتبار کارت تمام شده است.')
GO
INSERT [dbo].[gitmessage] ([id], [message]) VALUES (9, N'تاریخ تردد به خوابگاه مجاز نمی باشد.')
GO
INSERT [dbo].[gitmessage] ([id], [message]) VALUES (10, N'شخص خوابگاهی نمی باشد.')
GO
INSERT [dbo].[gitmessage] ([id], [message]) VALUES (11, N'کارت ناشناخته است.')
GO
INSERT [dbo].[gitmessage] ([id], [message]) VALUES (12, N'وضعیت اضطرای می باشد.')
GO
INSERT [dbo].[gitmessage] ([id], [message]) VALUES (13, N'مجوز تردد توسط نگهبان صادر شده است. ')
GO
INSERT [dbo].[gitmessage] ([id], [message]) VALUES (14, N'مجوز تردد به صورت اتوماتیک صادر شده است.')
GO
INSERT [dbo].[gitmessage] ([id], [message]) VALUES (15, N'تردد همزمان از دو مسیر صورت گرفته است.')
GO
INSERT [dbo].[gitmsgOperator] ([id], [messageUser]) VALUES (1, N'ورود موفق اپراتور')
GO
INSERT [dbo].[gitmsgOperator] ([id], [messageUser]) VALUES (2, N'ورود ناموفق اپراتور')
GO
INSERT [dbo].[gitmsgOperator] ([id], [messageUser]) VALUES (3, N'عدم اتصال با بانک اطلاعاتی')
GO
INSERT [dbo].[gitmsgOperator] ([id], [messageUser]) VALUES (4, N'ارتباط با بانک اطلاعاتی')
GO
INSERT [dbo].[gitmsgOperator] ([id], [messageUser]) VALUES (5, N'خالی بودن فیلد مورد نیاز برای ارتباط با بانک اطلاعاتی')
GO
INSERT [dbo].[gitmsgOperator] ([id], [messageUser]) VALUES (6, N'جستجوی دانشجو با مقدار معتبر')
GO
INSERT [dbo].[gitmsgOperator] ([id], [messageUser]) VALUES (7, N'جستجوی دانشجو با مقدار نامعتبر')
GO
INSERT [dbo].[gitmsgOperator] ([id], [messageUser]) VALUES (8, N'اجازه تردد موفق به دانشجو')
GO
INSERT [dbo].[gitmsgOperator] ([id], [messageUser]) VALUES (9, N'اجازه تردد ناموفق به دانشجو')
GO
INSERT [dbo].[gitmsgOperator] ([id], [messageUser]) VALUES (10, N'کلیک بر روی دکمه بستن نرم افزار')
GO
INSERT [dbo].[gitmsgOperator] ([id], [messageUser]) VALUES (11, N'کلیک بر روی دکمه کوچک نمایی نرم افزار')
GO
INSERT [dbo].[gitmsgOperator] ([id], [messageUser]) VALUES (12, N'خروج موفق کاربر از نرم افزار')
GO
INSERT [dbo].[gitmsgOperator] ([id], [messageUser]) VALUES (13, N'خروج ناموفق کاربر از نرم افزار')
GO
INSERT [dbo].[gitmsgOperator] ([id], [messageUser]) VALUES (14, N'عدم خروج از نرم افزار')
GO
SET IDENTITY_INSERT [dbo].[gitoperator] ON 

GO
INSERT [dbo].[gitoperator] ([id], [nam], [fam], [us], [pass], [timshowpic], [recordcount], [datcreate]) VALUES (1, N'مدیر', N'مدیر', N'admin', N'admin', 5000, 20, CAST(N'2016-11-14 00:00:00.000' AS DateTime))
GO
SET IDENTITY_INSERT [dbo].[gitoperator] OFF
GO
INSERT [dbo].[gitoption] ([datstartsuit], [pdatstartsuit], [datendsuit], [pdatendsuit], [genzoonw], [genzoonm], [emergency], [port]) VALUES (CAST(N'2016-10-10 00:00:00.000' AS DateTime), NULL, CAST(N'2017-10-10 00:00:00.000' AS DateTime), NULL, 0, 0, 0, 1470)
GO
SET IDENTITY_INSERT [dbo].[gitpermit] ON 

GO
INSERT [dbo].[gitpermit] ([id], [deviceId], [operatorId]) VALUES (2, 2, 1)
GO
INSERT [dbo].[gitpermit] ([id], [deviceId], [operatorId]) VALUES (5, 5, 1)
GO
INSERT [dbo].[gitpermit] ([id], [deviceId], [operatorId]) VALUES (6, 6, 1)
GO
INSERT [dbo].[gitpermit] ([id], [deviceId], [operatorId]) VALUES (7, 7, 1)
GO
INSERT [dbo].[gitpermit] ([id], [deviceId], [operatorId]) VALUES (9, 8, 1)
GO
SET IDENTITY_INSERT [dbo].[gitpermit] OFF
GO
SET IDENTITY_INSERT [dbo].[gituser] ON 

GO
INSERT [dbo].[gituser] ([id], [stu_id], [cdn], [nam], [fam], [gen], [suitmem], [suitname], [pic], [startdat], [pstartdat], [enddat], [penddat], [active], [typepass], [type], [comment]) VALUES (1, N'1395', N'4195469488', N'علی', N'محمدی', 1, 1, N'زیتون', NULL, CAST(N'2016-10-10 00:00:00.000' AS DateTime), NULL, CAST(N'2019-05-05 00:00:00.000' AS DateTime), NULL, 1, 1, 1, NULL)
GO
INSERT [dbo].[gituser] ([id], [stu_id], [cdn], [nam], [fam], [gen], [suitmem], [suitname], [pic], [startdat], [pstartdat], [enddat], [penddat], [active], [typepass], [type], [comment]) VALUES (2, N'1314', N'2387603920', N'فاطمه', N'داوودی', 2, 1, N'طلیعه', NULL, CAST(N'2016-10-10 00:00:00.000' AS DateTime), NULL, CAST(N'2019-05-10 00:00:00.000' AS DateTime), NULL, 1, 1, 1, NULL)
GO
INSERT [dbo].[gituser] ([id], [stu_id], [cdn], [nam], [fam], [gen], [suitmem], [suitname], [pic], [startdat], [pstartdat], [enddat], [penddat], [active], [typepass], [type], [comment]) VALUES (3, N'1315', N'1405579254', N'نسرین', N'کریمی', 2, 1, N'ملت', NULL, CAST(N'2016-01-01 00:00:00.000' AS DateTime), NULL, CAST(N'2020-12-12 00:00:00.000' AS DateTime), NULL, 1, 1, 1, NULL)
GO
INSERT [dbo].[gituser] ([id], [stu_id], [cdn], [nam], [fam], [gen], [suitmem], [suitname], [pic], [startdat], [pstartdat], [enddat], [penddat], [active], [typepass], [type], [comment]) VALUES (4, N'1316', N'291401908', N'محمد', N'ندایی', 1, 1, N'عارف', NULL, CAST(N'2016-01-01 00:00:00.000' AS DateTime), NULL, CAST(N'2020-12-12 00:00:00.000' AS DateTime), NULL, 1, 1, 1, NULL)
GO
SET IDENTITY_INSERT [dbo].[gituser] OFF
GO
SET IDENTITY_INSERT [dbo].[HC.direction] ON 

GO
INSERT [dbo].[HC.direction] ([id], [code], [name]) VALUES (1, 0, N'ورود')
GO
INSERT [dbo].[HC.direction] ([id], [code], [name]) VALUES (2, 1, N'خروج')
GO
SET IDENTITY_INSERT [dbo].[HC.direction] OFF
GO
SET IDENTITY_INSERT [dbo].[tbreqguest] ON 

GO
INSERT [dbo].[tbreqguest] ([id], [stu_id], [nam], [fam], [kind], [stuguest], [namguest], [cdnguest], [nesbat], [dats], [pdats], [datf], [pdatf], [cday], [nesbatdet], [status], [dat], [pdat], [suitx], [modirnam], [commodir]) VALUES (1, N'1395', N'علی', N'محمدی', 2, N'0', N'الهه مهدوی', N'4324260869', N'مادر', CAST(N'2016-08-12 00:00:00.000' AS DateTime), N'1395/09/18', CAST(N'2016-08-20 00:00:00.000' AS DateTime), N'1395/09/22', NULL, NULL, 0, CAST(N'2016-08-12 00:00:00.000' AS DateTime), NULL, 951, NULL, NULL)
GO
SET IDENTITY_INSERT [dbo].[tbreqguest] OFF
GO
ALTER TABLE [dbo].[gitlog]  WITH CHECK ADD  CONSTRAINT [FK_gitlog_gitdevice] FOREIGN KEY([deviceId])
REFERENCES [dbo].[gitdevice] ([id])
ON UPDATE CASCADE
GO
ALTER TABLE [dbo].[gitlog] CHECK CONSTRAINT [FK_gitlog_gitdevice]
GO
ALTER TABLE [dbo].[gitlog]  WITH CHECK ADD  CONSTRAINT [FK_gitlog_gitmessage] FOREIGN KEY([commentId])
REFERENCES [dbo].[gitmessage] ([id])
GO
ALTER TABLE [dbo].[gitlog] CHECK CONSTRAINT [FK_gitlog_gitmessage]
GO
ALTER TABLE [dbo].[gitlogOperator]  WITH CHECK ADD  CONSTRAINT [FK_gitlogOperator_gitmegOperator] FOREIGN KEY([msgopId])
REFERENCES [dbo].[gitmsgOperator] ([id])
ON UPDATE CASCADE
GO
ALTER TABLE [dbo].[gitlogOperator] CHECK CONSTRAINT [FK_gitlogOperator_gitmegOperator]
GO
ALTER TABLE [dbo].[gitpermit]  WITH CHECK ADD  CONSTRAINT [FK_gitpermit_gitdevice] FOREIGN KEY([deviceId])
REFERENCES [dbo].[gitdevice] ([id])
GO
ALTER TABLE [dbo].[gitpermit] CHECK CONSTRAINT [FK_gitpermit_gitdevice]
GO
ALTER TABLE [dbo].[gitpermit]  WITH CHECK ADD  CONSTRAINT [FK_gitpermit_gitoperator] FOREIGN KEY([operatorId])
REFERENCES [dbo].[gitoperator] ([id])
GO
ALTER TABLE [dbo].[gitpermit] CHECK CONSTRAINT [FK_gitpermit_gitoperator]
GO
USE [master]
GO
ALTER DATABASE [Test] SET  READ_WRITE 
GO
