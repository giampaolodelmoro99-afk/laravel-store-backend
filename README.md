### 📊 Database Architecture
Il sistema implementa un'architettura relazionale solida per la gestione del flusso di vendita:

*   **Customer ↔ Orders (1:N):** Ogni ordine è associato a un singolo cliente, garantendo la tracciabilità degli acquisti.
*   **Orders ↔ Products (N:M):** Relazione complessa gestita tramite tabella pivot `order_product`, ottimizzata per gestire carrelli multi-prodotto.
