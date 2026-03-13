import { ApplicationConfig, provideBrowserGlobalErrorListeners } from '@angular/core';
import { provideHttpClient } from '@angular/common/http';
import { provideRouter } from '@angular/router';
import { Home } from './component/home/home';
import { Graph } from './component/graph/graph';
import { Header } from './component/header/header';
import { Footer } from './component/footer/footer';

export const appConfig: ApplicationConfig = {
  providers: [
    provideBrowserGlobalErrorListeners(),
    provideHttpClient(),
    provideRouter([
      { path: '', component: Home },
      { path: 'app-graph', component: Graph },
      { path: 'app-header', component: Header },
      { path: 'app-footer', component: Footer },
    ])
  ]
};
