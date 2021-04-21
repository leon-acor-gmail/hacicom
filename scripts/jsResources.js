var jsResources = function () {

jsResources.prototype.utf8_to_b64 = function(str)
	{
    return window.btoa(unescape(encodeURIComponent(str)));
	}

  jsResources.prototype.b64_to_utf8 = function(str)
	{
    return decodeURIComponent(escape(window.atob(str)));
	}

	jsResources.prototype.populateCountries = function(domComponent,strJson)
		{
	    domComponent.empty();
			var items = [];
	    items.push('<ul class="w3-ul w3-card-4">');
	    $.each(jQuery.parseJSON(strJson), function(i,v) {
	      items.push('<li class="w3-bar">');
				items.push('<span onclick="deleteCountry(\''+v.L1+'\',\''+v.L2+'\');" class="w3-bar-item w3-button w3-transparent w3-large w3-right"><i class="fa fa-close"></i></span>');
				items.push('<img src="../countries/'+v.L3+'" class="w3-bar-item" style="width:85px;height:auto;">');
				items.push('<div class="w3-bar-item">');
				items.push('<span class="w3-large">'+v.L2+'</span><br>');
				items.push('</div>');
				items.push('</li>');
			});
			items.push('</ul>');
			domComponent.append( items.join('') );
	  }

		jsResources.prototype.populateFileds = function(domComponent,strJson)
			{
		    domComponent.empty();
				var items = [];
		    items.push('<ul class="w3-ul w3-card-4">');
		    $.each(jQuery.parseJSON(strJson), function(i,v) {
		      items.push('<li class="w3-display-container"> '+v.L2);
					items.push('<span onclick="deleteField(\''+v.L1+'\',\''+v.L2+'\');" class="w3-button w3-transparent w3-display-right"><i class="fa fa-close"></i></span>');
					items.push('</li>');
				});
				items.push('</ul>');
				domComponent.append( items.join('') );
		  }

		jsResources.prototype.populateSkills = function(domComponent,strJson)
			{
		    domComponent.empty();
				var items = [];
		    items.push('<ul class="w3-ul w3-card-4">');
		    $.each(jQuery.parseJSON(strJson), function(i,v) {
		      items.push('<li class="w3-display-container"> '+v.L2);
					items.push('<span onclick="deleteSkill(\''+v.L1+'\',\''+v.L2+'\');" class="w3-button w3-transparent w3-display-right"><i class="fa fa-close"></i></span>');
					items.push('</li>');
				});
				items.push('</ul>');
				domComponent.append( items.join('') );
		  }


			jsResources.prototype.populateSelectFieldsSkills = function(domComponentFields,domComponentSkills,strJson)
				{
					var jsonFields = strJson.split('|')[0];
					var jsonSkills = strJson.split('|')[1];
			    domComponentFields.empty();
					var items = [];
			    items.push('<select id="selectField" class="custom-select w3-section" required>');
					items.push('<option value="" selected>Selecciona algún area</option>');
			    $.each(jQuery.parseJSON(jsonFields), function(i,v) {
			      items.push('<option value="'+v.L1+'">'+v.L2+'</option>');
					});
					items.push('</select>');
					domComponentFields.append( items.join('') );

					domComponentSkills.empty();
					var items = [];
			    items.push('<select id="selectSkill" class="custom-select w3-section" required>');
					items.push('<option value="" selected>Selecciona algún interés</option>');
			    $.each(jQuery.parseJSON(jsonSkills), function(i,v) {
			      items.push('<option value="'+v.L1+'">'+v.L2+'</option>');
					});
					items.push('</select>');
					domComponentSkills.append( items.join('') );
			  }

				jsResources.prototype.populateFieldsSkillsSpan = function(domComponent,strJson)
					{
						domComponent.empty();
						var items = [];
						objJson = JSON.parse(strJson);
						for(var i = 0; i < 20; i++){
							strElement = objJson['cbValSkill'+i];
							if(strElement != undefined)
							{
								strSkill = objJson['skill'+strElement];
								items.push('<span class="badge w3-dark-grey w3-medium" style="margin-right:2px;margin-bottom:5px;">'+strSkill+'</span>');
							}
						}
						domComponent.append( items.join('') );
					}

			jsResources.prototype.populateFieldsSkills = function(domComponent,strJson,strResponsive)
				{
					arrJson = strJson.split('|');
			    domComponent.empty();
					var items = [];
					var strCode = '';
					var iIndexY=0;
					var iIndexX=0;
			    items.push('<div id="accordion">');//div1
			    $.each(jQuery.parseJSON(arrJson[0]), function(i,v) {
						if(v.L1!=strCode)
						{
				      items.push('<div class="card">');//div2
							items.push('<div class="card-header collapseColorHaCi" data-toggle="collapse" href="#collapse'+i+'" onclick="setColorField(this);">');//div3
							items.push('<a class="collapsed card-link">'+v.L2+'</a><i class="fa fa-angle-down w3-right w3-xlarge"></i>');
							items.push('</div>');//div3
							items.push('<div id="collapse'+i+'" class="collapse in w3-text-dark-gray" data-parent="#accordion">');//div4
							items.push('<div class="card-body">');//div5
							items.push('<div class="row">');//div6
							iIndexY=0;
							iIndexX=0;
							$.each(jQuery.parseJSON(arrJson[0]), function(j,w) {
								if(v.L1==w.L1){
									if(iIndexX==0){
										items.push('<div class="col align-items-start">');//div7
										iIndexX++;
										iIndexY++;
									}
									if(iIndexY<5){//columnas
										items.push('<label class="containerSkills">'+w.L4);
										items.push('<input type="checkbox" value="'+w.L5+'" id="cbValSkill'+strResponsive+j+'">');
										items.push('<span class="checkmarkSkills"></span>');
										items.push('</label>');
										iIndexX++;
									}
									else{
										iIndexY=0;
									}
									if(iIndexX==6){//renglones
										items.push('</div>');//div7
										iIndexX=0;
									}
								}
								//strCode=v.L1;
							});
							items.push('</div>');//div6
							items.push('</div>');//div5
							items.push('</div>');//div4
							items.push('</div>');//div2
							strCode=v.L1;
						}
					});
					items.push('</div>');//div1
					domComponent.append( items.join('') );
			  }

					//jsResources.prototype.populateSelectCountries = function(domComponent,idName,strJson)
					jsResources.prototype.populateSelectCountries = function(domComponent,strJson)
						{
					    domComponent.empty();
							var items = [];
					    //items.push('<select id="'+idName+'" class="custom-select w3-section" required>');
							items.push('<option value="" selected>Elige una opción</option>');
					    $.each(jQuery.parseJSON(strJson), function(i,v) {
					      items.push('<option data-flag="'+v.L3+'" value="'+v.L1+'">'+v.L2+'</option>');
							});
							//items.push('</select>');
							domComponent.append( items.join('') );
					  }

						jsResources.prototype.populateListPlaces = function(domComponent,strJson,strResponsive)
							{
						    domComponent.empty();
								var items = [];
						    items.push('<ul class="w3-ul w3-card-4">');
						    $.each(jQuery.parseJSON(strJson), function(i,v) {
						      items.push('<li class="w3-display-container"> ');
									items.push('<label class="containerSkills"> '+v.L2);
									items.push('<input type="checkbox" value="'+v.L1+'" id="cbValPlace'+strResponsive+i+'">');
									items.push('<span class="checkmarkSkills"></span>');
									items.push('</label>');
									//items.push('<span onclick="deleteSkill(\''+v.L1+'\',\''+v.L2+'\');" class="w3-button w3-transparent w3-display-right"><i class="fa fa-close"></i></span>');
									items.push('</li>');
								});
								items.push('</ul>');
								domComponent.append( items.join('') );
						  }

							jsResources.prototype.populateDropboxFieldsSkils = function(domComponent,strJson,strResponsive)
								{
									arrJson = strJson.split('|');
									domComponent.empty();
									var items = [];
									var iCount=1;
									items.push('<div class="btn-group" style="width:100%;">');
									items.push('<button class="btn btnColorHaCi dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Habilidades</button>');
									items.push('<div class="dropdown-menu">');
									$.each(jQuery.parseJSON(arrJson[1]), function(i,v) {
										iIndex = 1;
										$.each(jQuery.parseJSON(arrJson[0]), function(j,w) {
											if(v.L2==w.L1){
												if(iIndex<=v.L3){
													if(iIndex==1){
														items.push('<a class="dropdown-item"><b>'+v.L1+'</b></a>');
														items.push('<a class="dropdown-item">');
														items.push('<input type="checkbox" onclick="setLookupSkillSpan(\''+w.L4+'\');" class="form-check-input" value="'+w.L3+'" id="cbValSkill'+strResponsive+iCount+'">');
														items.push('<label class="form-check-label" for="cbValSkill'+strResponsive+iCount+'">'+w.L4+'</label>');
														items.push('</a>');
													}
													else {
														items.push('<a class="dropdown-item">');
														items.push('<input type="checkbox" onclick="setLookupSkillSpan(\''+w.L4+'\');" class="form-check-input" value="'+w.L3+'" id="cbValSkill'+strResponsive+iCount+'">');
														items.push('<label class="form-check-label" for="cbValSkill'+strResponsive+iCount+'">'+w.L4+'</label>');
														items.push('</a>');
													}
													if (iIndex==v.L3) {
														items.push('<div class="dropdown-divider"></div>');
													}
													iIndex++;
													iCount++;
												}
											}
										});
									});
									items.push('</div>');
									items.push('</div>');
									domComponent.append( items.join('') );
								}

								jsResources.prototype.populateLookupSkillSpan = function(domComponent,strElement)
									{
										domComponent.append('<span class="badge w3-dark-grey w3-small">'+strElement+'</span>');
									}

									jsResources.prototype.populateLookupPlaceSpan = function(domComponent,strElement)
										{
											domComponent.append('<span class="badge w3-dark-grey w3-small">'+strElement+'</span>');
										}

								jsResources.prototype.populateDropboxCountries = function(domComponent,strJson,strResponsive)
									{
										//alert(strJson);
										domComponent.empty();
										var items = [];
										var iCount=1;
										items.push('<div class="btn-group" style="width:100%;">');
										items.push('<button class="btn btnColorHaCi dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Países</button>');
										items.push('<div class="dropdown-menu">');
										$.each(jQuery.parseJSON(strJson), function(i,v) {
											items.push('<a class="dropdown-item">');
											items.push('<input type="checkbox" onclick="setLookupPlaceSpan(\''+v.L2+'\');" class="form-check-input" value="'+v.L1+'" id="cbValPlace'+strResponsive+iCount+'">');
											items.push('<label class="form-check-label" for="cbValPlace'+strResponsive+iCount+'">'+v.L2+'</label>');
											items.push('</a>');
											iCount++;
										});
										items.push('</div>');
										items.push('</div>');
										domComponent.append( items.join('') );
									}

									jsResources.prototype.populateCardsLookupResults = function(domComponent,strJson,strEmailOwn,iResponsive,iModule,strNicknameOwn)
										{
											//alert(strJson);
											domComponent.empty();
											var items = [];
											strUser='';
											$.each(jQuery.parseJSON(strJson), function(i,v) {
												strHashId=$.md5(v.L4);
												if(iModule == 0)//lookup crew
												{
													if(iResponsive==0)//large
													{
														if(v.L7!=1)
														{
															items.push('<div class="row w3-text-white w3-margin w3-card-4 w3-round" style="background-color:rgba(255,255,255,0.55);">');//div1
																items.push('<div class="col">');//div2
																		items.push('<div class="w3-container">');//div4
																			items.push('<img src="../uploads/'+v.L6+'" alt="shot" class="w3-left w3-margin" style="width:40px;height:auto;">');
																			items.push('<label class="w3-medium">'+v.L1+' ('+v.L5+')</label><br>');
																			arrSkills = (v.L2).split(',');
																			for(i=0;i<arrSkills.length;i++)
																			{
																				items.push('<span class="w3-small badge w3-dark-grey" style="margin:1px;">'+arrSkills[i]+'</span>');
																			}
																			items.push('<img src="../countries/'+v.L3+'" alt="Pais de residencia" style="width:33px;heigth:auto;margin-left:10px;">');
																		items.push('</div>');//div4
																items.push('</div>');//div2
																items.push('<div class="col">');//div2
																items.push('<button id="'+strHashId+'" style="width:96.5%;position:absolute;bottom:0px;border-radius: 0px 0px 4px 0px;background-image:linear-gradient(to right,rgba(222, 85, 45, 0.81),rgba(204, 44, 17, 0.86));" onclick="objResources.setUsersLink(\''+strHashId+'\',\''+strEmailOwn+'\',\''+v.L4+'\',\''+v.L5+'\',\''+strNicknameOwn+'\');" class="w3-button w3-block w3-small"><i class="fa fa-user-plus"></i> Invitar a mi crew</button>');
																items.push('</div>');//div2
															items.push('</div>');//div1
														}
													}
													else//small
													{
														if(v.L7!=1)
														{
															items.push('<div class="row w3-text-white" style="margin-top:25px;margin-bottom:25px;">');//div1
																items.push('<div class="col">');//div2
																	items.push('<div class="w3-card-4 w3-round" style="background-color:rgba(255,255,255,0.55);">');//div3
																		items.push('<div class="w3-container">');//div4
																			items.push('<img src="../uploads/'+v.L6+'" alt="shot" class="w3-left w3-margin" style="width:40px;height:auto;">');
																			items.push('<label class="w3-large" style="margin-top:6px;">'+v.L1+' ('+v.L5+')</label><br>');
																			arrSkills = (v.L2).split(',');
																			for(i=0;i<arrSkills.length;i++)
																			{
																				items.push('<span class="w3-small badge w3-dark-grey" style="margin:1px;">'+arrSkills[i]+'</span>');
																			}
																			items.push('<img src="../countries/'+v.L3+'" alt="Pais de residencia" class="w3-right" style="width:33px;heigth:auto;margin-bottom:13px;">');
																		items.push('</div>');//div4
																	items.push('<button id="'+strHashId+'" style="border-radius: 0px 0px 4px 4px;background-image:linear-gradient(to right,rgba(222, 85, 45, 0.81),rgba(204, 44, 17, 0.86));" onclick="objResources.setUsersLink(\''+strHashId+'\',\''+strEmailOwn+'\',\''+v.L4+'\',\''+v.L5+'\',\''+strNicknameOwn+'\');" class="w3-button w3-block w3-small"><i class="fa fa-user-plus"></i> Invitar a mi crew</button>');
																	items.push('</div>');//div3
																items.push('</div>');//div2
															items.push('</div>');//div1
														}
													}
												}
												else//mycrew
												{
													if(iResponsive==0)//large
													{
														items.push('<div class="row w3-text-white w3-margin w3-card-4 w3-round" style="background-color:rgba(255,255,255,0.55);">');//div1
															items.push('<div class="col">');//div2
																	items.push('<div class="w3-container">');//div4
																		items.push('<img src="../uploads/'+v.L6+'" alt="shot" class="w3-left w3-margin" style="width:40px;height:auto;">');
																		items.push('<label class="w3-medium">'+v.L1+' ('+v.L5+')</label><br>');
																		arrSkills = (v.L2).split(',');
																		for(i=0;i<arrSkills.length;i++)
																		{
																			items.push('<span class="w3-small badge w3-dark-grey" style="margin:1px;">'+arrSkills[i]+'</span>');
																		}
																		items.push('<img src="../countries/'+v.L3+'" alt="Pais de residencia" style="width:33px;heigth:auto;margin-left:10px;">');
																	items.push('</div>');//div4
															items.push('</div>');//div2
															items.push('<div class="col">');//div2
															items.push('<button style="width:46.7%;position:absolute;bottom:0px;background-image:linear-gradient(to right,rgba(222, 85, 45, 0.81),rgba(204, 44, 17, 0.86));" onclick="objResources.removeUsersLink(\''+strEmailOwn+'\',\''+v.L4+'\',\''+v.L5+'\');" class="w3-button w3-small"><i class="fa fa-user-times"></i> Desvincular</button><button onclick="objResources.getUserProfile(\''+v.L4+'\',$(\'#divModalUserLinkedProfile\'));" style="border-radius: 0px 0px 4px 0px;width:50%;position:absolute;bottom:0px;right:0px;background-image:linear-gradient(to right,rgba(222, 85, 45, 0.81),rgba(204, 44, 17, 0.86));" class="w3-button w3-small"><i class="fa fa-user"></i> Ver perfil</button>');
															items.push('</div>');//div2
														items.push('</div>');//div1
													}
													else//small
													{
														items.push('<div class="row w3-text-white w3-margin">');//div1
															items.push('<div class="col">');//div2
																items.push('<div class="w3-card-4 w3-round" style="background-color:rgba(255,255,255,0.55);">');//div3
																	items.push('<div class="w3-container">');//div4
																		items.push('<img src="../uploads/'+v.L6+'" alt="shot" class="w3-left w3-margin" style="width:40px;height:auto;">');
																		items.push('<label class="w3-medium" style="margin-top:6px;">'+v.L1+' ('+v.L5+')</label><br>');
																		arrSkills = (v.L2).split(',');
																		for(i=0;i<arrSkills.length;i++)
																		{
																			items.push('<span class="w3-small badge w3-dark-grey" style="margin:1px;">'+arrSkills[i]+'</span>');
																		}
																		items.push('<img src="../countries/'+v.L3+'" alt="Pais de residencia" class="w3-right" style="width:33px;heigth:auto;margin-bottom:13px;">');
																	items.push('</div>');//div4
																items.push('<button onclick="objResources.removeUsersLink(\''+strEmailOwn+'\',\''+v.L4+'\',\''+v.L5+'\');" class="w3-button w3-small" style="width:50%;background-image:linear-gradient(to right,rgba(222, 85, 45, 0.81),rgba(204, 44, 17, 0.86));"><i class="fa fa-user-times"></i> Desvincular</button>');
																items.push('<button onclick="objResources.getUserProfile(\''+v.L4+'\',$(\'#divModalUserLinkedProfile\'));" class="w3-button w3-small" style="width:50%;border-radius: 0px 0px 4px 4px;background-image:linear-gradient(to right,rgba(222, 85, 45, 0.81),rgba(204, 44, 17, 0.86));"><i class="fa fa-user"></i> Ver perfil</button>');
																items.push('</div>');//div3
															items.push('</div>');//div2
														items.push('</div>');//div1
													}
												}
											});
											domComponent.append( items.join('') );
										}

										jsResources.prototype.setUsersLink = function(btnHashId,strEmailOwn,strEmailLinked,strNicknameLinked,strNicknameOwn)
											{
												$('#'+btnHashId).prop( "disabled", true );
												bConfirm = confirm('Quieres invitar a ' + strNicknameLinked + ' a formar parte de tu crew');
												if(bConfirm)
												{
													objJson = {
														arg1:strEmailOwn,
														arg2:strEmailLinked
													};
													strJson = JSON.stringify(objJson);
													base = objResources.utf8_to_b64(strJson);

													$.post('../bsns/bsnsHome.php',{c:9,arg:base},function(s){
														if(s<=5){
															$.post('../bsns/bsnsHome.php',{c:4,arg:base},function(r){
																strTo=strEmailLinked;
																strSub='Unete al crew de '+strNicknameOwn;
																strMsg='Ingresa a la plataforma de <a href="https://www.hagamoscine.com/">Hagamos Cine</a> y revisa tus notificaciones para aceptar la invitación';
																//alert('email own:'+strEmailOwn+'- email link:'+ strEmailLinked + '- nickname own: ' + strNicknameOwn + ' - nickname link: '+ strNicknameLinked);
																$.post('../bsns/bsnsSendEmail.php',{to:strTo,sub:strSub,msg:strMsg},function(r){
																	if(r==1){
																		getUserRequest();
																		alert('Se ha enviado un correo a '+strNicknameLinked+' para notificarle que lo invitaste a tu crew');
																	}
																	else {
																		alert('Algo salió mal, intenta de nuevo por favor');
																	}
																});
															});
														}
														else {
															alert('Haz llegado al limite de tus vinculaciones');
														}
													});
												}
												else {
													$('#'+btnHashId).prop( "disabled", false );
												}
											}

											jsResources.prototype.removeUsersLink = function(strEmailOwn,strEmailLinked,strNickname)
												{
													bConfirm = confirm('Quieres que ' + strNickname + ' deje de formar parte de tu crew');
													if(bConfirm)
													{
														objJson = {
															arg1:strEmailOwn,
															arg2:strEmailLinked
														};
														strJson = JSON.stringify(objJson);
														base = objResources.utf8_to_b64(strJson);
														$.post('../bsns/bsnsHome.php',{c:6,arg:base},function(r){
															alert('Se ha enviado un correo a '+strNickname+' para notificarle que lo removiste de tu crew');
															getUsersLinked();
															getChat();
														});
														//alert(strJson);
													}
												}

												jsResources.prototype.populateUserRequest = function(domComponent,strUserOwn,strUserLink, iResponsive)
													{
														domComponent.empty();
														var items = [];
														$.each(jQuery.parseJSON(strUserOwn), function(i,v) {
															/*items.push('<div class="alert alert-info w3-margin" role="alert">');
															items.push('<h4 class="alert-heading">Invitación enviada</h4>');
															items.push('<p>Estamos esperando que '+v.L3+' acepte la invitación</p>');
															items.push('<hr>');
															items.push('<p class="mb-0">Cuando conteste recibirás una notificación</p>');
															items.push('</div>');*/
															items.push('<div class="w3-margin w3-round" style="background-color:rgba(255,255,255,0.55);">');
															items.push('<p style="padding:8px 16px 8px 16px;"><img style="width:20px;height:auto;" src="../images/web-iconos-stepers-active.png" srcset="../images/web-iconos-stepers-active@2x.png 2x,../images/web-iconos-stepers-active@3x.png 3x"> Estamos esperando que '+v.L3+' responda la invitación</p>');
															items.push('</div>');
														});

														$.each(jQuery.parseJSON(strUserLink), function(i,v) {
															/*items.push('<div class="alert alert-primary w3-margin" role="alert">');
															items.push('<h4 class="alert-heading">Invitación recibida</h4>');
															items.push('<p>'+v.L3+' esta esperando que aceptes la invitación</p>');
															items.push('<hr>');
															items.push('<button onclick="objResources.setRequestStatus(\''+v.L4+'\',\''+v.L2+'\',5);" class="btn btn-success">Aceptar</button> <button onclick="objResources.setRequestStatus(\''+v.L4+'\',\''+v.L2+'\',6);" class="btn btn-danger">Rechazar</button>');
															items.push('</div>');*/
															/*items.push('<div class="alert w3-text-white" style="background-color:rgba(255,255,255,0.55);" role="alert">');
															items.push('<img style="width:20px;height:auto;" src="../images/web-iconos-stepers-active.png" srcset="../images/web-iconos-stepers-active@2x.png 2x,../images/web-iconos-stepers-active@3x.png 3x">');
															items.push('<p>'+v.L3+' esta esperando que respuesta a la invitación</p>');
															items.push('<button onclick="objResources.setRequestStatus(\''+v.L4+'\',\''+v.L2+'\',5);" class="btn" style="">Aceptar</button> <button onclick="objResources.setRequestStatus(\''+v.L4+'\',\''+v.L2+'\',6);" class="btn btn-danger">Rechazar</button>');
															items.push('</div>');*/
															if(iResponsive==0){
															items.push('<div class="w3-margin w3-round" style="background-color:rgba(255,255,255,0.55);">');
															items.push('<span onclick="objResources.setRequestStatus(\''+v.L4+'\',\''+v.L2+'\',6);" style="border-radius: 0px 4px 4px 0px;" class="w3-button w3-red w3-right"><i class="fa fa-trash-o"></i></span>');
															items.push('<span onclick="objResources.setRequestStatus(\''+v.L4+'\',\''+v.L2+'\',5);" class="w3-button w3-teal w3-right"><i class="fa fa-check"></i></span>');
															//items.push('<img style="width:20px;height:auto;" src="../images/web-iconos-stepers-active.png" srcset="../images/web-iconos-stepers-active@2x.png 2x,../images/web-iconos-stepers-active@3x.png 3x">');
															items.push('<p style="padding:8px 16px 8px 16px;"><img style="width:20px;height:auto;" src="../images/web-iconos-stepers-active.png" srcset="../images/web-iconos-stepers-active@2x.png 2x,../images/web-iconos-stepers-active@3x.png 3x"> '+v.L3+' esta esperando tu respuesta a la invitación</p>');
															items.push('</div>');
																}
															else {


															items.push('<div class="w3-margin w3-round" style="background-color:rgba(255,255,255,0.55);">');
															/*items.push('<span onclick="objResources.setRequestStatus(\''+v.L4+'\',\''+v.L2+'\',6);" style="border-radius: 0px 4px 4px 0px;" class="w3-button w3-teal w3-right"><i class="fa fa-trash-o"></i></span>');
															items.push('<span onclick="objResources.setRequestStatus(\''+v.L4+'\',\''+v.L2+'\',5);" class="w3-button w3-red w3-right"><i class="fa fa-check"></i></span>');*/
															//items.push('<img style="width:20px;height:auto;" src="../images/web-iconos-stepers-active.png" srcset="../images/web-iconos-stepers-active@2x.png 2x,../images/web-iconos-stepers-active@3x.png 3x">');
															items.push('<p style="padding:8px 16px 8px 16px;"><img style="width:20px;height:auto;" src="../images/web-iconos-stepers-active.png" srcset="../images/web-iconos-stepers-active@2x.png 2x,../images/web-iconos-stepers-active@3x.png 3x"> '+v.L3+' esta esperando tu respuesta a la invitación</p>');
															items.push('<button onclick="objResources.setRequestStatus(\''+v.L4+'\',\''+v.L2+'\',5);" class="w3-button w3-teal w3-block">Aceptar</button>');
															items.push('<button onclick="objResources.setRequestStatus(\''+v.L4+'\',\''+v.L2+'\',6);" class="w3-button w3-red w3-block" style="border-radius: 0px 0px 4px 4px;" >Rechazar</button>');
															items.push('</div>');
															}
														});





														domComponent.append( items.join('') );
													}

													jsResources.prototype.setRequestStatus = function(strEmailOwn,strEmailLinked,iStatus)
														{
															objJson = {
																arg1:strEmailOwn,
																arg2:strEmailLinked,
																arg3:iStatus
															};
															strJson = JSON.stringify(objJson);
															base=objResources.utf8_to_b64(strJson);

															$.post('../bsns/bsnsHome.php',{c:9,arg:base},function(s){
																if(s<=5){
																	$.post('../bsns/bsnsHome.php',{c:8,arg:base},function(r){
																		if(iStatus==5)
																		{
																			alert('Haz aceptado la invitación');
																		}
																		else {
																			alert('Haz rechazado la invitación');
																		}
																		getUserRequest();
																		getUsersLinked();
																	});
																}
																else {
																	alert('Haz llegado al limite de tus vinculaciones');
																}
															});

														}

														jsResources.prototype.populateListChatContacts = function(domComponent,strJson)
															{
																alert(strJson);
																domComponent.empty();
																var items = [];
																items.push('<div class="w3-container">');
																items.push('<div class="topnav"><a class="active aNavElement" id="btnCallSmall">Contactos mi crew</a></div>');
																items.push('<ul class="w3-ul">');
																$.each(jQuery.parseJSON(strJson), function(i,v) {
																	items.push('<li class="w3-bar w3-border-0 w3-hover-opacity" onclick="setToMsg(\''+v.L1+'\',\''+v.L4+'\')">');
																	items.push('<div class="w3-bar-item">');
																	items.push('<span><i class="fa fa-circle w3-tiny w3-text-green"></i></span> ');
																	items.push('<img src="../uploads/'+v.L6+'" alt="shot chat" style="width:40px;height:auto;">');
																	items.push('<span class="w3-small"> '+v.L1+'</span>');
																	//items.push('<span>Web Designer</span>');
																	items.push('</div>');
																	items.push('</li>');
																});
																items.push('</ul>');
																items.push('</div>');
																domComponent.append( items.join('') );
															}

															jsResources.prototype.populateListChatMessges = function(domComponent,strJson)
																{
																	alert(strJson);
																	domComponent.empty();
																	var items = [];
																	items.push('<div class="w3-container">');

																	$.each(jQuery.parseJSON(strJson), function(i,v) {
																		items.push('<li class="w3-bar w3-dark-grey" style="margin: 10px 0px 10px 0px;">');

																	});
																	items.push('</ul>');
																	items.push('</div>');
																	domComponent.append( items.join('') );
																}

																jsResources.prototype.getUserProfile = function(strUser,domComponent)
																	{
																		objJson= {arg1:strUser};
													          strJson = JSON.stringify(objJson);
													          base64 = objResources.utf8_to_b64(strJson);
													          $.post('../bsns/bsnsHome.php',{c:11,arg:base64},function(r){
																			 $.post('../bsns/bsnsHome.php',{c:2},function(s){
																				 $.post('../bsns/bsnsHome.php',{c:12,arg:base64},function(t){
																					base = objResources.b64_to_utf8(r);
																					objJson = JSON.parse(base);
																					domComponent.empty();
																					var items = [];
																					items.push('<div class="w3-modal-content w3-card-4 w3-round" style="background-color:rgba(0,0,0,0.9);border-color:#de552d;border-style:solid;border-width:medium;">');
																					items.push('<header class="w3-container w3-padding">');
																					items.push('<span onclick="document.getElementById(\'divModalUserLinkedProfile\').style.display=\'none\'" class="w3-button w3-large w3-display-topright"><i class="fa fa-times w3-xlarge"></i></span>');
																					items.push('<p class="w3-large"><i class="fa fa-user"></i> Perfil de mi crew</p>');
																					items.push('</header>');
																					items.push('<div class="w3-container">');
																					items.push('<div class="w3-row">');
																					items.push('<div class="w3-container w3-quarter w3-center">');
																					items.push('<img class="w3-margin" src="../uploads/'+objJson.shotSystem+'" alt="shot" style="width:100px;height:auto;">');
																					items.push('</div>');
																					items.push('<div class="w3-container w3-half">');
																					items.push('<p class="w3-large"><b>'+objJson.name+' '+objJson.lastname+'</b></p>');
																					items.push('<span class="w3-medium badge w3-dark-grey" style="margin:1px;">País de residencia</span>');
																					items.push('<p><img class="w3-margin" src="../countries/'+objJson.countryFlag+'" alt="país de residencia" style="width:55px;height:auto;"></p>');
																					items.push('<span class="w3-medium badge w3-dark-grey" style="margin:1px;">Disponibilidad de trabajar en estos países</span>');
																					items.push('<p>');
																					for(i=0;i<s;i++){
																						strElement = objJson['cbValPlace'+i];
																						if(strElement != undefined)
																						{
																							strFlagCode = 'flag'+strElement;
																							items.push('<img class="w3-margin" src="../countries/'+objJson[strFlagCode]+'" alt="país de residencia" style="width:55px;height:auto;">');
																						}
																					}
																					items.push('</p>');
																					items.push('</div>');
																					items.push('<div class="w3-container w3-quarter w3-center">');
																					if((objJson.yt).length != 0)
																					{
																						items.push('<a href="'+objJson.yt+'" class="w3-margin"><img src="../images/youtube.png" alt="youtube" style="width:30px;height:auto;"></a>');
																					}
																					if((objJson.ig).length != 0)
																					{
																						items.push('<a href="'+objJson.ig+'" class="w3-margin"><img src="../images/instagram.png" alt="instagram" style="width:30px;height:auto;"></a>');
																					}
																					if((objJson.vi).length != 0)
																					{
																						items.push('<a href="'+objJson.vi+'" class="w3-margin"><img src="../images/vimeo.png" alt="vimeo" style="width:30px;height:auto;"></a>');
																					}
																					items.push('</div>');
																					items.push('</div>');
																					items.push('<span class="w3-medium badge w3-dark-grey" style="margin:1px;">Bio</span>');
																					items.push('<p class="w3-margin">'+objJson.bio+'</p>');
																					strJsonFields = objResources.b64_to_utf8(t);
																					items.push('<span class="w3-medium badge w3-dark-grey" style="margin:1px;">Departamentos</span>');
																					$.each(jQuery.parseJSON(strJsonFields), function(i,v) {
																						items.push('<p class="w3-margin">'+v.L1+'</p>');
																					});
																					items.push('</div>');
																					items.push('<footer class="w3-container w3-padding">');
																					items.push('<p class="w3-right">'+objJson.name+' tiene vínculos con otros ### profesionistas del cine</p>');
																					items.push('</footer>');
																					items.push('</div>');
																					domComponent.append( items.join('') );
																					document.getElementById('divModalUserLinkedProfile').style.display='block';
																				});
																			});
																		});
																	}



}