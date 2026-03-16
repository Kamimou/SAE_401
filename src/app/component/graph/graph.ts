import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
// import { RouterLink } from '@angular/router';
import { LogementService } from '../../services/logement';

@Component({
  selector: 'app-graph',
  standalone: true,
  imports: [CommonModule],
  templateUrl: './graph.html',
  styleUrl: './graph.css'
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