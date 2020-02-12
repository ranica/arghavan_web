
-- table gitUser
Update  [10.9.0.20].[Test].[dbo].[gituser]  
			set		 [gituser].stu_id		= [gituser].stu_id,
					 [gituser].cdn			= [gituser].cdn,  
					 [gituser].nam			= [gituser].nam,
					 [gituser].fam			= [gituser].fam,
					 [gituser].gen			= [gituser].gen,
					 [gituser].suitmem		= [gituser].suitmem,
					 [gituser].suitname		= [gituser].suitname,
					 [gituser].pic			= [gituser].pic,
					 [gituser].startdat		= [gituser].startdat,
					 [gituser].pstartdat	= [gituser].pstartdat,
					 [gituser].enddat		= [gituser].enddat,
					 [gituser].penddat		= [gituser].penddat,
					 [gituser].active		= [gituser].active,
					 [gituser].typepass		= [gituser].typepass,
					 [gituser].[type]		= [gituser].[type],
					 [gituser].comment		= [gituser].comment	

			FROM [10.0.0.74].[SQLIKIU].[dbo].[gituser]  
			INNER JOIN [10.9.0.20].[Test].[dbo].[gituser] 
					ON ([dbo].[gituser].stu_id  =  [dbo].[gituser].stu_id)


INSERT INTO [10.9.0.20].[Test].[dbo].[gituser]  
			([stu_id]
           ,[cdn]
           ,[nam]
           ,[fam]
           ,[gen]
           ,[suitmem]
           ,[suitname]
           ,[pic]
           ,[startdat]
           ,[pstartdat]
           ,[enddat]
           ,[penddat]
           ,[active]
           ,[typepass]
           ,[type]
           ,[comment])

	SELECT  [stu_id]
           ,[cdn]
           ,[nam]
           ,[fam]
           ,[gen]
           ,[suitmem]
           ,[suitname]
           ,[pic]
           ,[startdat]
           ,[pstartdat]
           ,[enddat]
           ,[penddat]
           ,[active]
           ,[typepass]
           ,[type]
           ,[comment]

	FROM [10.0.0.74].[SQLIKIU].[dbo].[gituser] 
	WHERE [stu_id] NOt IN (Select [stu_id] FROM [10.9.0.20].[Test].[dbo].[gituser] )
	
	
	-- 

	
