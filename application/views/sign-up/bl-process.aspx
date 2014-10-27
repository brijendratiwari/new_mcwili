 %%[

		SET @fname = RequestParameter("firstname")
		SET @email = RequestParameter("email")
		SET @lname = RequestParameter("lastname")
		SET @day = RequestParameter("birthDay")
		SET @month = RequestParameter("birthMonth")
		SET @year = RequestParameter("birthYear")
		SET @dob = Concat(@day,"/",@month,"/",@year)
		SET @pref1 = RequestParameter("pref1")
		SET @pref2 = RequestParameter("pref2")
		SET @pref3 = RequestParameter("pref3")
		SET @pref4 = RequestParameter("pref4")
		
		SET @sub = CreateObject("Subscriber")
		SetObjectProperty(@sub,"EmailAddress",@email)
		SetObjectProperty(@sub,"SubscriberKey",@email)
		
		Set @Att = CreateObject("Attribute")
		SetObjectProperty(@Att,"Name","First Name")
		SetObjectProperty(@Att,"Value",@fname)
		AddObjectArrayItem(@sub,"Attributes", @Att)
			
		Set @Att = CreateObject("Attribute")
		SetObjectProperty(@Att,"Name","Last Name")
		SetObjectProperty(@Att,"Value",@lname)
		AddObjectArrayItem(@sub,"Attributes", @Att)
			
		Set @Att = CreateObject("Attribute")
		SetObjectProperty(@Att,"Name","DOB")
		SetObjectProperty(@Att,"Value",@dob)
		AddObjectArrayItem(@sub,"Attributes", @Att)
	


	
		Set @List = CreateObject("SubscriberList")
		SetObjectProperty(@List,"ID","351484")  
		SetObjectProperty(@List,"Status","Active")
		AddObjectArrayItem(@sub,"Lists",@List)

	
		IF @pref1 == "on" THEN
			Set @List = CreateObject("SubscriberList")
			SetObjectProperty(@List,"ID","351486")  
			SetObjectProperty(@List,"Status","Active")
			AddObjectArrayItem(@sub,"Lists",@List)
		ENDIF

		IF @pref2 == "on" THEN
			Set @List = CreateObject("SubscriberList")
			SetObjectProperty(@List,"ID","351485")  
			SetObjectProperty(@List,"Status","Active")
			AddObjectArrayItem(@sub,"Lists",@List)
		ENDIF

		IF @pref3 == "on" THEN
			Set @List = CreateObject("SubscriberList")
			SetObjectProperty(@List,"ID","351487")  
			SetObjectProperty(@List,"Status","Active")
			AddObjectArrayItem(@sub,"Lists",@List)
		ENDIF	
	
		IF @pref4 == "on" THEN
			Set @List = CreateObject("SubscriberList")
			SetObjectProperty(@List,"ID","351488")  
			SetObjectProperty(@List,"Status","Active")
			AddObjectArrayItem(@sub,"Lists",@List)
		ENDIF	
		
		SET @Retrieve = CreateObject("RetrieveRequest")
		SetObjectProperty(@Retrieve, "ObjectType", "Subscriber")
		AddObjectArrayItem(@Retrieve,"Properties","EmailAddress")

		  SET @SubFilter = CreateObject("SimpleFilterPart")
		  SetObjectProperty(@SubFilter,"Property","EmailAddress")
		  SetObjectProperty(@SubFilter,"SimpleOperator","equals")
		  AddObjectArrayItem(@SubFilter,"Value",@email)
		  
      SetObjectProperty(@Retrieve, "Filter", @SubFilter)
	  
      SET @RetrieveResult = InvokeRetrieve(@Retrieve,@status_rr,@reqID) 
	  Output(RowCount(@RetrieveResult))
	  
	  	
		
	   Output(v(@tsstatus))
	   IF RowCount(@RetrieveResult)== 0 Then
	 
		Set @Att = CreateObject("Attribute")
		SetObjectProperty(@Att,"Name","Joined On")
		SetObjectProperty(@Att,"Value",Now())
		AddObjectArrayItem(@sub,"Attributes", @Att)
	
		Set @update_sub = InvokeCreate(@sub, @statusMsg, @errorCode)

			IF @update_sub == "OK" THEN
					Output(v("INvoked Created"))
					
				 Redirect(MicrositeURL(1998,"email",@email))
			ELSE
						Output(v("Error"))
				 Redirect("http://pages.s6.exacttarget.com/brandslaira/error/") 
			ENDIF

	  ELSE
	  	   SET @UpdateResult=InvokeUpdate(@sub,@status_msg,@Update_err)

			IF @UpdateResult == "OK" Then
			Output(v("INvoked Update"))
			 Redirect(MicrositeURL(1998,"email",@email))
			ELSE
			Output(v("Update Error"))
			 Redirect("http://pages.s6.exacttarget.com/brandslaira/error/") 
			ENDIF
			
	  ENDIF



]%% 