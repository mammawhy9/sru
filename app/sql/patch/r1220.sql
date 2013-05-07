ALTER TABLE dormitories ADD COLUMN vlan bigint NOT NULL DEFAULT 42;
ALTER TABLE dormitories ADD CONSTRAINT dormitories_vlan_fkey FOREIGN KEY (vlan) REFERENCES vlans (id) ON UPDATE CASCADE ON DELETE CASCADE;