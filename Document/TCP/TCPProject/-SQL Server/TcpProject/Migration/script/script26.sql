USE [SQLIKIU]
GO
/****** Object:  Table [dbo].[gitcomment]    Script Date: 11/16/2016 12:14:07 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[gitcomment](
	[id] [int] IDENTITY(0,1) NOT NULL,
	[message] [nvarchar](50) NULL
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[gitdevice]    Script Date: 11/16/2016 12:14:07 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[gitdevice](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[ip] [nvarchar](50) NULL,
	[port] [int] NULL,
	[namedevice] [nvarchar](50) NULL,
	[active] [bit] NULL,
	[gen] [int] NULL,
	[zoon] [nvarchar](50) NULL,
	[direction] [int] NULL,
	[netstatus] [bit] NULL,
	[timresponse] [datetime] NULL
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[gitlog]    Script Date: 11/16/2016 12:14:07 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[gitlog](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[stu_id] [nvarchar](50) NULL,
	[nam] [nvarchar](50) NULL,
	[fam] [nvarchar](50) NULL,
	[pic] [nvarchar](50) NULL,
	[direction] [int] NULL,
	[tim] [smalldatetime] NULL,
	[dat] [datetime] NULL,
	[devicid] [int] NULL,
	[typepass] [int] NULL,
	[commentid] [int] NULL
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[gitlogoperator]    Script Date: 11/16/2016 12:14:07 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[gitlogoperator](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[ip] [nvarchar](50) NULL,
	[us] [nvarchar](50) NULL,
	[pass] [nvarchar](50) NULL,
	[tim] [smalldatetime] NULL,
	[dat] [datetime] NULL,
	[success] [int] NULL,
	[descript] [nvarchar](500) NULL,
	[typeevent] [nvarchar](50) NULL
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[gitoprator]    Script Date: 11/16/2016 12:14:07 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[gitoprator](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[nam] [nvarchar](50) NULL,
	[fam] [nvarchar](50) NULL,
	[us] [nvarchar](50) NULL,
	[pass] [nvarchar](50) NULL,
	[timshowpic] [int] NULL,
	[recordCount] [int] NULL,
	[datcreate] [datetime] NULL
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[gitoption]    Script Date: 11/16/2016 12:14:07 PM ******/
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
	[genzoonm] [int] NULL,
	[emergency] [int] NULL,
	[timpassage] [int] NULL,
	[timserver] [int] NULL
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[gitpermit]    Script Date: 11/16/2016 12:14:07 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[gitpermit](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[iddevice] [int] NULL,
	[idoprator] [int] NULL
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[gituser]    Script Date: 11/16/2016 12:14:07 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[gituser](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[stu_id] [nvarchar](50) NOT NULL,
	[cdn] [nvarchar](50) NULL,
	[nam] [nvarchar](50) NULL,
	[fam] [nvarchar](50) NULL,
	[gen] [int] NULL,
	[suit] [nvarchar](50) NULL,
	[suitnam] [nvarchar](50) NULL,
	[pic] [nvarchar](50) NULL,
	[startdat] [datetime] NULL,
	[pstartdat] [nvarchar](50) NULL,
	[enddat] [datetime] NULL,
	[penddate] [nvarchar](50) NULL,
	[active] [bit] NULL,
	[type] [int] NULL,
	[typepass] [nchar](10) NULL,
	[comment] [nvarchar](1000) NULL
) ON [PRIMARY]

GO
SET IDENTITY_INSERT [dbo].[gitcomment] ON 

INSERT [dbo].[gitcomment] ([id], [message]) VALUES (0, N'تردد انجام شد')
INSERT [dbo].[gitcomment] ([id], [message]) VALUES (1, N'تردد انجام نشد')
INSERT [dbo].[gitcomment] ([id], [message]) VALUES (2, N'شخص مجوز تردد دارد')
INSERT [dbo].[gitcomment] ([id], [message]) VALUES (3, N'قبلا تردد داشته است')
INSERT [dbo].[gitcomment] ([id], [message]) VALUES (4, N'مجاز به تردد از این ناحیه نمی باشد')
INSERT [dbo].[gitcomment] ([id], [message]) VALUES (5, N'جنسیت مطابقت ندارد')
INSERT [dbo].[gitcomment] ([id], [message]) VALUES (6, N'دستگاه غیر فعال است')
INSERT [dbo].[gitcomment] ([id], [message]) VALUES (7, N'تردد کننده غیرفعال است')
INSERT [dbo].[gitcomment] ([id], [message]) VALUES (8, N'تاریخ تردد مجاز نمی باشد')
INSERT [dbo].[gitcomment] ([id], [message]) VALUES (9, N'تاریخ تردد به خوابگاه مجاز نمی باشد')
INSERT [dbo].[gitcomment] ([id], [message]) VALUES (10, N'شخص خوابگاهی نمی باشد')
INSERT [dbo].[gitcomment] ([id], [message]) VALUES (11, N'کارت ناشناخته است')
INSERT [dbo].[gitcomment] ([id], [message]) VALUES (12, N'وضعیت اضطراری می باشد')
INSERT [dbo].[gitcomment] ([id], [message]) VALUES (13, N'مجوز تردد توسط نگهبان صادر شده است')
INSERT [dbo].[gitcomment] ([id], [message]) VALUES (14, N'مجوز تردد به صورت اتوماتیک صادر شده است')
SET IDENTITY_INSERT [dbo].[gitcomment] OFF
