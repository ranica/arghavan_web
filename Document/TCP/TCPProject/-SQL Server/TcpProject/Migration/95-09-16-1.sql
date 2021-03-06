USE [Test]
GO
/****** Object:  Table [dbo].[gitdevice]    Script Date: 06/12/2016 04:13:15 ب.ظ ******/
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
/****** Object:  Table [dbo].[gitlog]    Script Date: 06/12/2016 04:13:15 ب.ظ ******/
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
/****** Object:  Table [dbo].[gitlogOperator]    Script Date: 06/12/2016 04:13:15 ب.ظ ******/
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
/****** Object:  Table [dbo].[gitmessage]    Script Date: 06/12/2016 04:13:15 ب.ظ ******/
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
/****** Object:  Table [dbo].[gitmsgOperator]    Script Date: 06/12/2016 04:13:15 ب.ظ ******/
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
/****** Object:  Table [dbo].[gitoperator]    Script Date: 06/12/2016 04:13:15 ب.ظ ******/
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
/****** Object:  Table [dbo].[gitoption]    Script Date: 06/12/2016 04:13:15 ب.ظ ******/
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
/****** Object:  Table [dbo].[gitpermit]    Script Date: 06/12/2016 04:13:15 ب.ظ ******/
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
/****** Object:  Table [dbo].[gituser]    Script Date: 06/12/2016 04:13:15 ب.ظ ******/
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
/****** Object:  Table [dbo].[HC.direction]    Script Date: 06/12/2016 04:13:15 ب.ظ ******/
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
/****** Object:  Table [dbo].[tbreqguest]    Script Date: 06/12/2016 04:13:15 ب.ظ ******/
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
	[status] [int] NULL,
	[dat] [datetime] NULL,
	[pdat] [nvarchar](50) NULL,
	[suitx] [int] NULL,
	[modirnam] [nvarchar](50) NULL,
	[commodir] [nvarchar](50) NULL,
 CONSTRAINT [PK_tbreqguest] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET IDENTITY_INSERT [dbo].[gitdevice] ON 

GO
INSERT [dbo].[gitdevice] ([id], [ipmain], [ipforegin], [namedevice], [active], [zoon], [direction], [gen], [netStatus], [timpssage], [timserver]) VALUES (2, N'10.9.19.12', N'192.168.0.3', N'شماره 2 - ورود', 1, N'0', 0, 0, 0, 3, 5)
GO
INSERT [dbo].[gitdevice] ([id], [ipmain], [ipforegin], [namedevice], [active], [zoon], [direction], [gen], [netStatus], [timpssage], [timserver]) VALUES (5, N'10.9.19.13', N'192.168.0.2', N'شماره 2 - خروج', 1, N'0', 1, 0, 0, 3, 5)
GO
INSERT [dbo].[gitdevice] ([id], [ipmain], [ipforegin], [namedevice], [active], [zoon], [direction], [gen], [netStatus], [timpssage], [timserver]) VALUES (6, N'10.9.19.14', N'10.9.19.15', N'شماره 3 - ورود', 1, N'0', 0, 0, 0, 3, 5)
GO
INSERT [dbo].[gitdevice] ([id], [ipmain], [ipforegin], [namedevice], [active], [zoon], [direction], [gen], [netStatus], [timpssage], [timserver]) VALUES (7, N'10.9.19.15', N'10.9.19.14', N'شماره 3 - خروج', 1, N'0', 1, 0, 0, 2, 3)
GO
INSERT [dbo].[gitdevice] ([id], [ipmain], [ipforegin], [namedevice], [active], [zoon], [direction], [gen], [netStatus], [timpssage], [timserver]) VALUES (8, N'10.9.19.16', N'10.9.19.17', N'شماره 4 - ورود', 1, N'0', 0, 0, 0, 2, 2)
GO
INSERT [dbo].[gitdevice] ([id], [ipmain], [ipforegin], [namedevice], [active], [zoon], [direction], [gen], [netStatus], [timpssage], [timserver]) VALUES (9, N'10.9.19.17', N'10.9.19.16', N'شماره 4 - خروج', 1, N'0', 1, 0, 0, 3, 3)
GO
INSERT [dbo].[gitdevice] ([id], [ipmain], [ipforegin], [namedevice], [active], [zoon], [direction], [gen], [netStatus], [timpssage], [timserver]) VALUES (10, N'10.9.19.18', N'10.9.19.19', N'شماره 5 - ورود', 1, N'0', 0, 0, 0, 5, 5)
GO
INSERT [dbo].[gitdevice] ([id], [ipmain], [ipforegin], [namedevice], [active], [zoon], [direction], [gen], [netStatus], [timpssage], [timserver]) VALUES (11, N'10.9.19.19', N'10.9.19.28', N'شماره 5 - خروج', 1, N'0', 1, 0, 0, 5, 5)
GO
INSERT [dbo].[gitdevice] ([id], [ipmain], [ipforegin], [namedevice], [active], [zoon], [direction], [gen], [netStatus], [timpssage], [timserver]) VALUES (12, N'10.9.19.20', N'10.9.19.21', N'شماره 6- ورود', 1, N'0', 0, 0, 0, 5, 5)
GO
INSERT [dbo].[gitdevice] ([id], [ipmain], [ipforegin], [namedevice], [active], [zoon], [direction], [gen], [netStatus], [timpssage], [timserver]) VALUES (13, N'10.9.19.21', N'10.9.19.20', N'شماره 6 - خروج', 1, N'0', 1, 0, 0, 5, 5)
GO
INSERT [dbo].[gitdevice] ([id], [ipmain], [ipforegin], [namedevice], [active], [zoon], [direction], [gen], [netStatus], [timpssage], [timserver]) VALUES (14, N'10.9.19.22', N'10.9.19.23', N'شماره 7 - ورود', 1, N'0', 0, 0, 0, 5, 5)
GO
INSERT [dbo].[gitdevice] ([id], [ipmain], [ipforegin], [namedevice], [active], [zoon], [direction], [gen], [netStatus], [timpssage], [timserver]) VALUES (15, N'10.9.19.23', N'10.9.19.22', N'شماره 7 - خروج', 1, N'0', 1, 0, 0, 5, 5)
GO
INSERT [dbo].[gitdevice] ([id], [ipmain], [ipforegin], [namedevice], [active], [zoon], [direction], [gen], [netStatus], [timpssage], [timserver]) VALUES (16, N'10.9.19.24', N'10.9.19.25', N'شماره 8- ورود', 1, N'0', 0, 0, 0, 5, 5)
GO
INSERT [dbo].[gitdevice] ([id], [ipmain], [ipforegin], [namedevice], [active], [zoon], [direction], [gen], [netStatus], [timpssage], [timserver]) VALUES (17, N'10.9.19.25', N'10.9.19.24', N'شماره 8 - خروج', 1, N'0', 1, 0, 0, 5, 5)
GO
INSERT [dbo].[gitdevice] ([id], [ipmain], [ipforegin], [namedevice], [active], [zoon], [direction], [gen], [netStatus], [timpssage], [timserver]) VALUES (18, N'10.9.19.26', N'10.9.19.27', N'شماره 1 - ورود', 1, N'0', 0, 0, 0, 5, 5)
GO
INSERT [dbo].[gitdevice] ([id], [ipmain], [ipforegin], [namedevice], [active], [zoon], [direction], [gen], [netStatus], [timpssage], [timserver]) VALUES (19, N'10.9.19.27', N'10.9.19.26', N'شماره 1 - خروج', 1, N'0', 1, 0, 0, 5, 5)
GO
INSERT [dbo].[gitdevice] ([id], [ipmain], [ipforegin], [namedevice], [active], [zoon], [direction], [gen], [netStatus], [timpssage], [timserver]) VALUES (20, N'127.0.0.1', N'127.0.0.1', N'تست', 1, N'0', 1, 0, 1, 2, 2)
GO
SET IDENTITY_INSERT [dbo].[gitdevice] OFF
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
INSERT [dbo].[gitoption] ([datstartsuit], [pdatstartsuit], [datendsuit], [pdatendsuit], [genzoonw], [genzoonm], [emergency], [port]) VALUES (CAST(N'2016-10-10 00:00:00.000' AS DateTime), NULL, CAST(N'2017-10-10 00:00:00.000' AS DateTime), NULL, 1, 1, 0, 1470)
GO
SET IDENTITY_INSERT [dbo].[gitpermit] ON 

GO
INSERT [dbo].[gitpermit] ([id], [deviceId], [operatorId]) VALUES (2, 2, 1)
GO
INSERT [dbo].[gitpermit] ([id], [deviceId], [operatorId]) VALUES (5, 5, 1)
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
