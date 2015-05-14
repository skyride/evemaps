SELECT t1.solarSystemID AS originID, t1.solarSystemName AS originName, t1.x AS originX, t1.y AS originY, t1.z AS originZ,
t2.solarSystemID AS destID, t2.solarSystemName AS destName, t2.x AS destX, t2.y AS destY, t2.z AS destZ
FROM  `mapJumps` 
INNER JOIN mapDenormalize tt1 ON mapJumps.stargateID = tt1.itemID
INNER JOIN mapSolarSystems t1 ON tt1.solarSystemID = t1.solarSystemID
INNER JOIN mapDenormalize tt2 ON mapJumps.destinationID = tt2.itemID
INNER JOIN mapSolarSystems t2 ON tt2.solarSystemID = t2.solarSystemID
