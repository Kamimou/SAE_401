import { ApplicationConfig, importProvidersFrom, provideBrowserGlobalErrorListeners } from '@angular/core';
import { provideHttpClient } from '@angular/common/http';
import { provideRouter } from '@angular/router';
import { Home } from './component/home/home';
import { GraphComponent } from './component/graph/graph';
import { CommonModule } from '@angular/common';

export const appConfig: ApplicationConfig = {
  providers: [
    provideBrowserGlobalErrorListeners(),
    provideHttpClient(),
    importProvidersFrom(CommonModule),
    provideRouter([
      { path: '', component: Home },
      
      { path: 'graphique', component: GraphComponent },
    ])
  ]
};
