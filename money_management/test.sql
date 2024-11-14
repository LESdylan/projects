SELECT
    id,
    category_id,
    qty,
    qty_unit,
    price_per_item,
    price_unit,
    ROUND(CASE 
        WHEN qty_unit = 'gram' AND qty_unit >= 1000 AND price_unit = 'kg' THEN (qty / 1000) * price_per_item
        WHEN qty_unit = 'unit' AND price_unit = 'unit' THEN qty * price_per_item
        WHEN qty_unit = 'gram' AND qty_unit >= 100 AND price_unit = 'kg' THEN qty * price_per_item
        ELSE NULL  -- Option pour gérer les unités sans correspondance
    END,2) AS total_euros
FROM expenses_by_items;