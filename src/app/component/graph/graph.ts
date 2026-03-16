import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { LogementService } from '../../services/logement';

@Component({
  selector: 'app-graph',
  standalone: true,
  imports: [CommonModule],
  templateUrl: './graph.html',
  styleUrls: ['./graph.css']
})
export class GraphComponent implements OnInit {
  logements: any[] = [];

  constructor(private logementService: LogementService) {}

  ngOnInit(): void {
    this.logementService.getLogements().subscribe({
      next: (data) => {
        console.log('Données API reçues :', data);
        this.logements = [...data];
      },
      error: (err) => {
        console.error('Erreur API :', err);
      }
    });
  }
}