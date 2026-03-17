import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';
import { Observable } from 'rxjs';
import { LogementService } from '../../services/logement';

@Component({
  selector: 'app-graph',
  standalone: true,
  imports: [CommonModule],
  templateUrl: './graph.html',
  styleUrls: ['./graph.css']
})
export class GraphComponent {
  readonly logements$: Observable<any[]>;

  constructor(private logementService: LogementService) {
    this.logements$ = this.logementService.logements$;
  }
}
