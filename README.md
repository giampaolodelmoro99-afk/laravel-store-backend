### 📊 Architettura del Database
Il progetto implementa i seguenti pattern relazionali:

- **One-to-Many (1:N):** Gestione di Customer -> Orders, dove ogni elemento appartiene a una singola entità genitore.
- **Many-to-Many (N:M):** Gestione di Orders <-> Products, implementata tramite tabelle pivot ottimizzate.
