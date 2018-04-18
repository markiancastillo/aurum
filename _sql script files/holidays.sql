USE [aurum]
GO

/****** Object:  Table [dbo].[holidays]    Script Date: 19/04/2018 5:34:52 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[holidays](
	[holidayID] [int] IDENTITY(1,1) NOT NULL,
	[holidayName] [varchar](100) NOT NULL,
	[holidayDate] [date] NOT NULL,
 CONSTRAINT [PK_holidays] PRIMARY KEY CLUSTERED 
(
	[holidayID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO


