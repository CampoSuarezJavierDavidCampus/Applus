import { Component } from '@angular/core';
import { RouterOutlet } from '@angular/router';
import { ProductModule } from '@product/product.module';


@Component({
  selector: 'app-root',
  standalone: true,
  imports: [
    RouterOutlet,
    ProductModule
  ],
  templateUrl: './app.component.html',
  styleUrl: './app.component.css'
})
export class AppComponent {
  title = 'shop';
}
