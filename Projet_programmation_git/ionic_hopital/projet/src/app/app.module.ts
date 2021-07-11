import { PersonnelService } from './service/personnel.service';
import { SpecialiteService } from './service/specialite.service';
import { GlobalService } from './service/global.service';
import { AuthService } from './service/auth.service';
import { LoginService } from './service/login.service';
import { UserService } from './service/user.service';
import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { RouteReuseStrategy } from '@angular/router';

import { IonicModule, IonicRouteStrategy } from '@ionic/angular';
import { SplashScreen } from '@ionic-native/splash-screen/ngx';
import { StatusBar } from '@ionic-native/status-bar/ngx';

import { AppComponent } from './app.component';
import { AppRoutingModule } from './app-routing.module';
import { ReactiveFormsModule } from '@angular/forms';
import {  HttpClientModule } from '@angular/common/http';


@NgModule({
  declarations: [AppComponent],
  entryComponents: [],
  imports: [
    BrowserModule,
    HttpClientModule,
    IonicModule.forRoot(),
    AppRoutingModule,
    ReactiveFormsModule,
  ],
  providers: [
    StatusBar,
    SplashScreen,
    { provide: RouteReuseStrategy, useClass: IonicRouteStrategy },
    UserService,
    LoginService,
    AuthService,
    GlobalService,
    SpecialiteService,
    PersonnelService,
  ],
  bootstrap: [AppComponent]
})
export class AppModule {}
