import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { BehaviorSubject, Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class LogementService {
  private apiUrl = 'https://127.0.0.1:8000/api/statistique_logements';
  private readonly _logements = new BehaviorSubject<any[]>([]);
  readonly logements$ = this._logements.asObservable();

  constructor(private http: HttpClient) {}

  loadLogements(): void {
    this.getLogements().subscribe({
      next: (data) => this._logements.next(data),
      error: (err) => console.error('Erreur API (service) :', err),
    });
  }

  getLogements(): Observable<any[]> {
    return this.http.get<any[]>(this.apiUrl);
  }
}