import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { RouterLink } from '@angular/router';
import { LogementService } from '../services/logement';

@Component({
  selector: 'app-graph',
  standalone: true,
  imports: [CommonModule, RouterLink],
  templateUrl: './graph.component.html',
  styleUrl: './graph.component.css'
})
export class GraphComponent implements OnInit {
  logements: any[] = [];

  constructor(private logementService: LogementService) {}

  ngOnInit(): void {
    this.logementService.getLogements().subscribe((data) => {
      this.logements = data;
      console.log(this.logements);
    });
  }
}